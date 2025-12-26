@extends('layouts.app')

@section('page_title', 'My Treatments')
@section('page_subtitle', 'Assigned cases & treatment updates')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white">Ongoing Treatments</h1>
        <p class="text-slate-400 text-sm mt-1">
            Manage active treatments, update status, and add medical records.
        </p>
    </div>

    <a href="{{ route('vet.dashboard') }}"
       class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold border border-white/10 transition">
        ← Back to Dashboard
    </a>
</div>

<div class="bg-slate-900/50 border border-white/5 rounded-2xl overflow-hidden shadow-xl">
    <table class="w-full text-left">
        <thead class="bg-slate-800/50">
            <tr class="text-xs text-slate-400 uppercase tracking-wider">
                <th class="px-6 py-4">Pet</th>
                <th class="px-6 py-4">Owner</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Started</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-white/5 text-sm">
            @forelse($treatments as $treatment)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-white font-semibold">
                        {{ $treatment->pet?->name ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-slate-400">
                        {{ $treatment->pet?->owner?->name ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'ongoing' => 'bg-sky-500/10 text-sky-400 border-sky-500/20',
                                'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            ];
                            $badgeClass = $statusColors[$treatment->status] ?? 'bg-slate-500/10 text-slate-300 border-slate-500/20';
                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                            {{ ucfirst($treatment->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-slate-400">
                        {{ optional($treatment->started_at ?? $treatment->created_at)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2 flex-wrap">

                            {{-- View Treatment --}}
                            <a href="{{ route('vet.treatments.show', $treatment->id) }}"
                               class="px-3 py-2 rounded-lg text-xs font-semibold
                               bg-slate-700/40 hover:bg-slate-600 text-white transition">
                                View
                            </a>

                            {{-- Medical History --}}
                            @if($treatment->pet)
                                <a href="{{ route('vet.medical.history', $treatment->pet->id) }}"
                                   class="px-3 py-2 rounded-lg text-xs font-semibold
                                   bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500 hover:text-white transition">
                                    History
                                </a>

                                {{-- Add Medical Record --}}
                                <a href="{{ route('vet.medical.create', $treatment->pet->id) }}"
                                   class="px-3 py-2 rounded-lg text-xs font-semibold
                                   bg-sky-500/10 text-sky-400 border border-sky-500/20 hover:bg-sky-500 hover:text-white transition">
                                    Add Record
                                </a>
                            @endif

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                        No treatments assigned yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="p-4 border-t border-white/5">
        {{ $treatments->links() }}
    </div>
</div>

@endsection
