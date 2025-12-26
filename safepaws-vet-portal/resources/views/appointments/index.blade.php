@extends('layouts.app')

@section('page_title', 'Appointments')
@section('page_subtitle', 'Manage vet appointments')

@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Appointments</h1>

    <a href="{{ route('vet.appointments.create') }}"
       class="bg-sky-600 hover:bg-sky-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-sky-600/20">
        + Book Appointment
    </a>
</div>

<div class="bg-slate-900/50 border border-white/5 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-800/50">
                <tr class="text-xs text-slate-400 uppercase tracking-wider">
                    <th class="py-4 px-6 font-medium">Pet</th>
                    <th class="py-4 px-6 font-medium">Branch</th>
                    <th class="py-4 px-6 font-medium">Date & Time</th>
                    <th class="py-4 px-6 font-medium">Status</th>
                    <th class="py-4 px-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                @forelse($appointments as $appointment)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="py-4 px-6 font-medium text-white">
                            {{ $appointment->pet?->name ?? 'Unknown' }}
                        </td>
                        <td class="py-4 px-6 text-slate-300">
                            {{ $appointment->branch?->name ?? 'Unknown' }}
                        </td>
                        <td class="py-4 px-6 text-slate-400 font-mono">
                            {{ $appointment->appointment_at?->format('d M Y, h:i A') }}
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $status = $appointment->status;
                                $badge = match($status) {
                                    'confirmed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                    'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    default => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded-md text-xs font-medium border {{ $badge }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('vet.appointments.show', $appointment) }}" class="text-sky-400 hover:text-white text-sm">View</a>
                            <a href="{{ route('vet.appointments.edit', $appointment) }}" class="text-amber-400 hover:text-white text-sm">Edit</a>

                            <form action="{{ route('vet.appointments.destroy', $appointment) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this appointment?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-white text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-6 text-center text-slate-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-white/5">
        {{ $appointments->links() }}
    </div>
</div>

@endsection
