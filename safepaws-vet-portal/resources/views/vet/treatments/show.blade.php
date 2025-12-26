@extends('layouts.app')

@section('page_title', 'Treatment Details')
@section('page_subtitle', 'Update progress & attach reports')

@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-slate-900/50 border border-white/5 rounded-2xl p-6">
        <h2 class="text-white font-bold text-lg mb-3">Treatment Info</h2>

        <p class="text-slate-300 text-sm mb-2"><b>Pet:</b> {{ $treatment->pet?->name }}</p>
        <p class="text-slate-300 text-sm mb-2"><b>Status:</b> {{ ucfirst($treatment->status) }}</p>
        <p class="text-slate-300 text-sm mb-2"><b>Notes:</b> {{ $treatment->notes ?? 'N/A' }}</p>

        <hr class="my-4 border-white/10">

        <h3 class="text-white font-semibold mb-2">Update Treatment</h3>

        <form action="{{ route('vet.treatments.update', $treatment) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-slate-400 mb-1">Status</label>
                <select name="status" class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white">
                    @foreach(['pending','ongoing','completed','cancelled'] as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Notes</label>
                <textarea name="notes" rows="4"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white"></textarea>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Attachment (JPG/PNG/PDF)</label>
                <input type="file" name="attachment"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-slate-300">
            </div>

            <button class="bg-sky-600 hover:bg-sky-500 text-white px-5 py-2 rounded-lg font-medium transition">
                Save Update
            </button>
        </form>
    </div>

    <div class="bg-slate-900/50 border border-white/5 rounded-2xl p-6">
        <h2 class="text-white font-bold text-lg mb-3">Updates History</h2>

        <div class="space-y-4">
            @forelse($treatment->updates as $update)
                <div class="p-4 rounded-xl bg-white/5 border border-white/5">
                    <p class="text-slate-300 text-sm"><b>Status:</b> {{ ucfirst($update->status) }}</p>
                    <p class="text-slate-400 text-sm"><b>Notes:</b> {{ $update->notes ?? '—' }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $update->created_at->format('d M Y, h:i A') }}</p>

                    @if($update->attachment)
                        <a href="{{ asset('storage/'.$update->attachment) }}" target="_blank"
                           class="text-sky-400 text-sm mt-2 inline-block">
                            View Attachment
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-slate-500 text-sm">No updates yet.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection

