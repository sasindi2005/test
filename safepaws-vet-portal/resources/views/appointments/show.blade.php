@extends('layouts.app')

@section('page_title', 'Appointment Details')
@section('page_subtitle', 'View appointment record')

@section('content')

<div class="max-w-3xl bg-slate-900/50 border border-white/5 rounded-2xl p-6 space-y-4">
    <div class="text-white text-xl font-bold">
        Appointment #{{ $appointment->id }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
            <div class="text-slate-400 text-xs uppercase">Pet</div>
            <div class="text-white font-medium">{{ $appointment->pet?->name }}</div>
        </div>

        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
            <div class="text-slate-400 text-xs uppercase">Branch</div>
            <div class="text-white font-medium">{{ $appointment->branch?->name }}</div>
        </div>

        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
            <div class="text-slate-400 text-xs uppercase">Date & Time</div>
            <div class="text-white font-medium">{{ $appointment->appointment_at?->format('d M Y, h:i A') }}</div>
        </div>

        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
            <div class="text-slate-400 text-xs uppercase">Status</div>
            <div class="text-white font-medium">{{ ucfirst($appointment->status) }}</div>
        </div>
    </div>

    @if($appointment->notes)
        <div class="bg-white/5 border border-white/5 rounded-xl p-4">
            <div class="text-slate-400 text-xs uppercase">Notes</div>
            <div class="text-slate-200 mt-1">{{ $appointment->notes }}</div>
        </div>
    @endif

    <div class="flex justify-end gap-3 pt-3">
        <a href="{{ route('vet.appointments.index') }}"
           class="px-4 py-2 rounded-lg border border-white/10 text-slate-300 hover:bg-white/5 transition">
            Back
        </a>

        <a href="{{ route('vet.appointments.edit', $appointment) }}"
           class="px-4 py-2 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-300 hover:bg-amber-500 hover:text-black transition">
            Edit
        </a>
    </div>
</div>

@endsection
