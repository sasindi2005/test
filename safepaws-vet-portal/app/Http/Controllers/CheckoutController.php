<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:25'],
            'customer_address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        // Validate stock before creating order
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || !$product->is_active) {
                return back()->with('error', 'A product is unavailable.');
            }
            if ($product->stock < $item['qty']) {
                return back()->with('error', "Not enough stock for {$product->name}");
            }
        }

        $total = collect($cart)->sum('subtotal');

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total' => $total,
            'currency' => 'LKR',
            ...$validated,
            'payment_status' => 'pending',
            'shipping_status' => 'pending',
            'payment_gateway' => 'payhere',
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->price,
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('payment.payhere', $order);
    }
}
