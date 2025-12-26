@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-10 space-y-8">

    <div class="flex items-center justify-between">
        <a href="{{ route('shop.index') }}" class="text-slate-300 hover:text-white transition">
            ← Back to Shop
        </a>

        <a href="{{ route('cart.index') }}"
           class="px-4 py-2 rounded-xl bg-slate-900 border border-white/10 text-white hover:bg-slate-800 transition">
            🛒 Cart ({{ array_sum(session('cart', [])) }})
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 glass-card rounded-2xl p-6">

        <div>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full h-96 object-cover rounded-xl border border-white/10"
                     alt="{{ $product->name }}">
            @else
                <div class="w-full h-96 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center text-slate-400">
                    No Image
                </div>
            @endif
        </div>

        <div class="space-y-5">
            <h1 class="text-3xl font-bold text-white">{{ $product->name }}</h1>

            <p class="text-slate-300">{{ $product->description }}</p>

            <div class="flex items-center justify-between">
                <p class="text-emerald-400 text-2xl font-bold">
                    Rs. {{ number_format($product->price, 2) }}
                </p>

                <span class="text-sm px-4 py-2 rounded-full bg-white/10 text-slate-200">
                    Stock: {{ $product->stock }}
                </span>
            </div>

            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <button class="w-full py-3 rounded-xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition">
                    Add to Cart
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
