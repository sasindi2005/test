@extends('layouts.shop')


@section('content')
<div class="p-6 lg:p-10 space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-white">Shop</h1>

        <a href="{{ route('cart.index') }}"
           class="inline-flex items-center justify-center px-5 py-2 rounded-xl bg-slate-900 border border-white/10 text-white hover:bg-slate-800 transition">
            🛒 View Cart
            <span class="ml-2 text-xs px-2 py-1 rounded-full bg-emerald-500 text-white">
                {{ array_sum(session('cart', [])) }}
            </span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="glass-card rounded-2xl p-5 flex flex-col justify-between">

                <div class="space-y-3">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-full h-44 object-cover rounded-xl border border-white/10"
                             alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-44 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center text-slate-400">
                            No Image
                        </div>
                    @endif

                    <div>
                        <h2 class="text-white font-semibold text-lg">
                            {{ $product->name }}
                        </h2>

                        <p class="text-slate-400 text-sm line-clamp-2">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="text-emerald-400 font-bold">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>
                        <span class="text-xs px-3 py-1 rounded-full bg-white/10 text-slate-200">
                            Stock: {{ $product->stock }}
                        </span>
                    </div>
                </div>

                <div class="mt-5 flex flex-col gap-2">
                    <a href="{{ route('shop.show', $product->slug) }}"
                       class="w-full text-center py-2 rounded-xl bg-slate-900 border border-white/10 text-white hover:bg-slate-800 transition">
                        View Details
                    </a>

                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button class="w-full py-2 rounded-xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition">
                            Add to Cart
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-slate-400 col-span-full text-center">No products available.</p>
        @endforelse
    </div>

    <div>
        {{ $products->links() }}
    </div>

</div>
@endsection
