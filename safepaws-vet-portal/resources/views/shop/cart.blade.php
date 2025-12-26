@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-10 space-y-8">

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Cart</h1>
        <a href="{{ route('shop.index') }}" class="text-slate-300 hover:text-white transition">
            ← Continue Shopping
        </a>
    </div>

    @if(empty($cartItems))
        <div class="glass-card rounded-2xl p-6 text-slate-400 text-center">
            Your cart is empty.
        </div>
    @else
        <div class="glass-card rounded-2xl p-6 space-y-5">

            @foreach($cartItems as $item)
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-white/10 pb-4">
                    <div>
                        <p class="text-white font-semibold">{{ $item['product']->name }}</p>
                        <p class="text-slate-400 text-sm">
                            Rs. {{ number_format($item['product']->price, 2) }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('cart.update', $item['product']->id) }}">
                            @csrf
                            <input type="number" min="1" name="qty"
                                   value="{{ $item['qty'] }}"
                                   class="w-20 px-3 py-2 rounded-xl bg-slate-900 border border-white/10 text-white">
                            <button class="ml-2 px-4 py-2 rounded-xl bg-slate-800 text-white hover:bg-slate-700 transition">
                                Update
                            </button>
                        </form>

                        <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                            @csrf
                            <button class="px-4 py-2 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 transition">
                                Remove
                            </button>
                        </form>
                    </div>

                    <p class="text-white font-semibold">
                        Rs. {{ number_format($item['subtotal'], 2) }}
                    </p>
                </div>
            @endforeach

            <div class="flex justify-between items-center pt-4">
                <p class="text-slate-200 font-semibold">Total</p>
                <p class="text-xl font-bold text-emerald-400">
                    Rs. {{ number_format($total, 2) }}
                </p>
            </div>

            <a href="{{ route('checkout') }}"
               class="block w-full text-center py-3 rounded-xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition">
                Proceed to Checkout
            </a>

        </div>
    @endif

</div>
@endsection
