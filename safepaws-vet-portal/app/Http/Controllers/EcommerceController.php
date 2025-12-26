<?php

namespace App\Http\Controllers;

use App\Models\Product;

class EcommerceController extends Controller
{
    /**
     * Display a listing of active products.
     */
    public function index()
    {
        // Fetch active products, latest first, paginated
        $products = Product::where('is_active', true)->latest()->paginate(12);

        return view('shop.index', compact('products'));
    }

    /**
     * Display a single product by slug.
     */
    public function show($slug)
    {
        // Fetch single active product by slug
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('shop.show', compact('product'));
    }
}

