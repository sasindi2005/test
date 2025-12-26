<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);

        // ✅ If cart empty
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)
            ->where('is_active', true)
            ->get();

        $cartItems = $products->map(function ($product) use ($cart) {

            $item = $cart[$product->id] ?? null;

            // ✅ Support both structures:
            // 1) [id => qty]
            // 2) [id => ['qty' => qty, ...]]
            $qty = is_array($item) ? ($item['qty'] ?? 1) : (int) $item;

            if ($qty < 1) $qty = 1;

            return [
                'product' => $product,
                'qty' => $qty,
                'subtotal' => $qty * (float) $product->price,
            ];
        });

        $total = $cartItems->sum('subtotal');

        return view('shop.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)
            ->where('is_active', true)
            ->lockForUpdate()
            ->get();

        return DB::transaction(function () use ($products, $cart, $validated) {

            $total = 0;

            foreach ($products as $product) {
                $item = $cart[$product->id] ?? null;
                $qty  = is_array($item) ? ($item['qty'] ?? 1) : (int) $item;

                if ($qty < 1) $qty = 1;

                // ✅ Stock check
                if ($product->stock < $qty) {
                    return redirect()->route('cart.index')
                        ->with('error', "Not enough stock for {$product->name}");
                }

                $total += $qty * (float) $product->price;
            }

            // ✅ Create Order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'notes' => $validated['notes'] ?? null,
                'total' => $total,
                'status' => 'pending',
            ]);

            // ✅ Create Order Items + reduce stock
            foreach ($products as $product) {
                $item = $cart[$product->id] ?? null;
                $qty  = is_array($item) ? ($item['qty'] ?? 1) : (int) $item;

                if ($qty < 1) $qty = 1;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $qty * (float) $product->price,
                ]);

                $product->decrement('stock', $qty);
            }

            // ✅ Clear cart
            session()->forget('cart');

            return redirect()->route('shop.index')->with('success', 'Order placed successfully!');
        });
    }
}
