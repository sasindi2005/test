@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-white">🛒 Shopping Cart</h1>

        <a href="{{ route('shop.index') }}"
           class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm font-semibold text-white transition">
            ← Continue Shopping
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-500/15 text-emerald-300 border border-emerald-500/20">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-500/15 text-red-300 border border-red-500/20">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($cart))
        <div class="p-8 rounded-xl bg-slate-900/60 border border-white/10 text-center">
            <p class="text-slate-300 text-lg">Your cart is empty 😢</p>
            <a href="{{ route('shop.index') }}"
               class="inline-block mt-4 px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-white font-semibold transition">
                Browse Products
            </a>
        </div>
    @else

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $item)
                <div class="p-4 rounded-xl bg-slate-900/60 border border-white/10 flex flex-col sm:flex-row gap-4">
                    
                    <!-- Image -->
                    <div class="w-full sm:w-32 h-24 overflow-hidden rounded-lg border border-white/10">
                        <img src="{{ $item['image'] ?? 'https://picsum.photos/seed/'.$id.'/300/200' }}"
                             alt="{{ $item['name'] }}"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Details -->
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-white">
                            {{ $item['name'] }}
                        </h2>

                        <p class="text-slate-400 text-sm mt-1">
                            LKR {{ number_format($item['price'], 2) }} each
                        </p>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-4 gap-3">

                            <!-- Qty Update -->
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')

                                <input type="number" name="qty"
                                       value="{{ $item['qty'] }}"
                                       min="1"
                                       class="w-20 px-3 py-2 rounded-lg bg-slate-800 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-sky-500">

                                <button class="px-4 py-2 rounded-lg bg-sky-500 hover:bg-sky-400 text-white text-sm font-semibold transition">
                                    Update
                                </button>
                            </form>

                            <!-- Remove -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-4 py-2 rounded-lg bg-red-500/15 hover:bg-red-500/25 text-red-300 border border-red-500/20 text-sm font-semibold transition">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="text-right min-w-[120px]">
                        <p class="text-slate-400 text-sm">Subtotal</p>
                        <p class="text-lg font-bold text-white">
                            LKR {{ number_format($item['subtotal'], 2) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="p-6 rounded-xl bg-slate-900/60 border border-white/10 h-fit">
            <h3 class="text-lg font-semibold text-white mb-4">Order Summary</h3>

            <div class="flex justify-between text-slate-300 mb-2">
                <span>Items</span>
                <span>{{ count($cart) }}</span>
            </div>

            <div class="flex justify-between text-slate-300 mb-2">
                <span>Total</span>
                <span class="font-bold text-white">LKR {{ number_format($total, 2) }}</span>
            </div>

            <div class="mt-6 space-y-3">
                <a href="{{ route('checkout') }}"
                   class="block w-full text-center px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-semibold transition">
                    ✅ Proceed to Checkout
                </a>

                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button class="w-full px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold transition">
                        Clear Cart
                    </button>
                </form>
            </div>
        </div>

    </div>

    @endif
</div>
@endsection
