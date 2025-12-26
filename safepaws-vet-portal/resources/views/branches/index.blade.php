@extends('layouts.app')

@section('page_title', 'Branches')
@section('page_subtitle', 'Manage all veterinary branch locations')

@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Branch Network</h1>

    <a href="{{ route('vet.branches.create') }}">
       class="bg-sky-600 hover:bg-sky-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-sky-600/20">
        + Add Branch
    </a>
</div>

<div class="bg-slate-900/50 border border-white/5 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-800/50">
                <tr class="text-xs text-slate-400 uppercase tracking-wider">
                    <th class="py-4 px-6 font-medium">Name</th>
                    <th class="py-4 px-6 font-medium">Phone</th>
                    <th class="py-4 px-6 font-medium">Status</th>
                    <th class="py-4 px-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                @forelse($branches as $branch)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="py-4 px-6 font-medium text-white">{{ $branch->name }}</td>
                        <td class="py-4 px-6 text-slate-300">{{ $branch->phone ?? '—' }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-md text-xs font-medium border
                                {{ $branch->status === 'open' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-red-500/10 text-red-400 border-red-500/20' }}">
                                {{ ucfirst($branch->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="{{ route('vet.branches.show', $branch) }}" class="text-sky-400 hover:text-white text-sm">View</a>
                            <a href="{{ route('vet.branches.edit', $branch) }}" class="text-amber-400 hover:text-white text-sm">Edit</a>

                            <form action="{{ route('vet.branches.destroy', $branch) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this branch?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-white text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 px-6 text-center text-slate-500">No branches found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-white/5">
        {{ $branches->links() }}
    </div>
</div>

@endsection
