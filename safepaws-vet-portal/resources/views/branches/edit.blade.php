@extends('layouts.app')

@section('page_title', 'Edit Branch')
@section('page_subtitle', 'Update branch information')

@section('content')

<div class="max-w-2xl bg-slate-900/50 border border-white/5 rounded-2xl p-6">
    <form action="{{ route('branches.update', $branch) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm text-slate-400 mb-1">Branch Name</label>
            <input type="text" name="name" value="{{ old('name', $branch->name) }}"
                   class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Address</label>
            <input type="text" name="address" value="{{ old('address', $branch->address) }}"
                   class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $branch->phone) }}"
                   class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Status</label>
            <select name="status"
                    class="w-full bg-slate-800 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-sky-500">
                <option value="open" {{ old('status', $branch->status) === 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status', $branch->status) === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('branches.index') }}"
               class="px-4 py-2 rounded-lg border border-white/10 text-slate-300 hover:bg-white/5 transition">
                Cancel
            </a>
            <button class="bg-sky-600 hover:bg-sky-500 text-white px-5 py-2 rounded-lg font-medium transition">
                Update Branch
            </button>
        </div>
    </form>
</div>

@endsection
