@extends('layouts.app')

@section('content')
<div class="p-6 lg:p-8 space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Treatments</h1>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card rounded-2xl overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-800/40 text-xs uppercase text-slate-400">
                <tr>
                    <th class="py-3 px-6">Pet</th>
                    <th class="py-3 px-6">Owner</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6">Notes</th>
                    <th class="py-3 px-6 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/5 text-sm">
                @foreach($treatments as $treatment)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="py-4 px-6 font-semibold text-white">
                            {{ $treatment->pet->name ?? '-' }}
                        </td>
                        <td class="py-4 px-6 text-slate-400">
                            {{ $treatment->pet->owner->name ?? '-' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-lg text-xs font-semibold border
                                @if($treatment->status === 'ongoing') bg-amber-500/10 text-amber-400 border-amber-500/20
                                @elseif($treatment->status === 'completed') bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @else bg-red-500/10 text-red-400 border-red-500/20 @endif">
                                {{ ucfirst($treatment->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-400 max-w-sm truncate">
                            {{ $treatment->notes ?? '-' }}
                        </td>

                        <td class="py-4 px-6 text-right">
                            <form method="POST" action="{{ route('treatments.updateStatus', $treatment) }}" class="flex items-center justify-end gap-2">
                                @csrf
                                <select name="status" class="bg-slate-900 border border-white/10 rounded-lg text-sm text-white px-2 py-1">
                                    <option value="ongoing" @selected($treatment->status === 'ongoing')>Ongoing</option>
                                    <option value="completed" @selected($treatment->status === 'completed')>Completed</option>
                                    <option value="cancelled" @selected($treatment->status === 'cancelled')>Cancelled</option>
                                </select>

                                <button class="px-3 py-1.5 rounded-lg bg-sky-500/10 text-sky-400 border border-sky-500/20 hover:bg-sky-500 hover:text-white transition text-xs font-semibold">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $treatments->links() }}
    </div>

</div>
@endsection
