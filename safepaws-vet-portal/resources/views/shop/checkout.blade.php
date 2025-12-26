@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-10 space-y-8">

    <h1 class="text-2xl font-bold text-white">Checkout</h1>

    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Order Summary --}}
        <div class="lg:col-span-2 glass-card rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-semibold text-white">Order Summary</h2>

            <div class="space-y-3">
                @foreach($cartItems as $item)
                    <div class="flex justify-between items-center border-b border-white/10 pb-3">
                        <div>
                            <p class="text-white font-semibold">{{ $item['product']->name }}</p>
                            <p class="text-slate-400 text-sm">
                                Qty: {{ $item['qty'] }} × Rs. {{ number_format($item['product']->price, 2) }}
                            </p>
                        </div>
                        <p class="text-white font-semibold">
                            Rs. {{ number_format($item['subtotal'], 2) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center pt-4">
                <p class="text-slate-300 font-semibold">Total</p>
                <p class="text-xl font-bold text-emerald-400">
                    Rs. {{ number_format($total, 2) }}
                </p>
            </div>
        </div>

        {{-- Checkout Form --}}
        <div class="glass-card rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-semibold text-white">Shipping Details</h2>

            <form method="POST" action="{{ route('order.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-slate-300 text-sm">Name</label>
                    <input name="name" required class="w-full mt-1 px-4 py-2 rounded-xl bg-slate-900 border border-white/10 text-white" />
                </div>

                <div>
                    <label class="text-slate-300 text-sm">Phone</label>
                    <input name="phone" required class="w-full mt-1 px-4 py-2 rounded-xl bg-slate-900 border border-white/10 text-white" />
                </div>

                <div>
                    <label class="text-slate-300 text-sm">Address</label>
                    <textarea name="address" required class="w-full mt-1 px-4 py-2 rounded-xl bg-slate-900 border border-white/10 text-white"></textarea>
                </div>

                <div>
                    <label class="text-slate-300 text-sm">Notes (optional)</label>
                    <textarea name="notes" class="w-full mt-1 px-4 py-2 rounded-xl bg-slate-900 border border-white/10 text-white"></textarea>
                </div>

                <button class="w-full py-3 rounded-xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition">
                    Place Order
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
