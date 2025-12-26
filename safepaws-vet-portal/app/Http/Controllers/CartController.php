<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get current cart from session
     */
    private function cart()
    {
        return session()->get('cart', []);
    }

    /**
     * Save cart to session
     */
    private function saveCart(array $cart)
    {
        session()->put('cart', $cart);
    }

    /**
     * Display cart contents
     */
    public function index()
    {
        $cart = $this->cart();
        $total = collect($cart)->sum('subtotal');
        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to cart
     */
    public function add(Request $request, Product $product)
    {
        $qty = max((int) $request->input('qty', 1), 1);

        $cart = $this->cart();
        $currentQty = isset($cart[$product->id]) ? $cart[$product->id]['qty'] : 0;
        $newQty = $currentQty + $qty;

        if ($newQty > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'image'      => $product->image,
            'qty'        => $newQty,
            'subtotal'   => $newQty * $product->price,
        ];

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Added to cart!');
    }

    /**
     * Update quantity of a cart item
     */
    public function update(Request $request, Product $product)
    {
        $qty = max((int) $request->input('qty', 1), 1);

        $cart = $this->cart();

        if (!isset($cart[$product->id])) {
            return back()->with('error', 'Item not found in cart.');
        }

        if ($qty > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart[$product->id]['qty'] = $qty;
        $cart[$product->id]['subtotal'] = $qty * $cart[$product->id]['price'];

        $this->saveCart($cart);

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove a product from the cart
     */
    public function remove(Product $product)
    {
        $cart = $this->cart();

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $this->saveCart($cart);
            return back()->with('success', 'Item removed!');
        }

        return back()->with('error', 'Item not found in cart.');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
}
