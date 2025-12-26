@extends('layouts.vet')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Medical History</h1>
            <p class="text-slate-400 text-sm">{{ $pet->name }} ({{ $pet->species }})</p>
        </div>

        <a href="{{ route('medical.create', $pet->id) }}"
           class="px-5 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 font-semibold text-white">
            + Add Record
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-emerald-500/10 text-emerald-300 border border-emerald-500/20">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($records as $record)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-white font-semibold">
                            {{ $record->created_at->format('d M Y, h:i A') }}
                        </p>
                        <p class="text-slate-400 text-sm">
                            Vet: {{ $record->vet->name ?? 'Unknown' }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-slate-300 text-sm font-semibold mb-1">Symptoms</p>
                        <p class="text-white">{{ $record->symptoms }}</p>
                    </div>

                    <div>
                        <p class="text-slate-300 text-sm font-semibold mb-1">Diagnosis</p>
                        <p class="text-white">{{ $record->diagnosis }}</p>
                    </div>
                </div>

                <!-- Prescription -->
                <div class="mt-4">
                    <p class="text-slate-300 text-sm font-semibold mb-2">Prescription</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-slate-400">
                                <tr>
                                    <th class="py-2">Medicine</th>
                                    <th class="py-2">Dose</th>
                                    <th class="py-2">Duration</th>
                                </tr>
                            </thead>
                            <tbody class="text-white">
                                @foreach($record->prescription ?? [] as $item)
                                    <tr class="border-t border-white/10">
                                        <td class="py-2">{{ $item['medicine'] ?? '-' }}</td>
                                        <td class="py-2">{{ $item['dose'] ?? '-' }}</td>
                                        <td class="py-2">{{ $item['duration'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Files -->
                @if($record->files->count())
                    <div class="mt-4">
                        <p class="text-slate-300 text-sm font-semibold mb-2">Attachments</p>

                        <div class="flex flex-wrap gap-3">
                            @foreach($record->files as $file)
                                <a href="{{ route('medical.file.download', $file->id) }}"
                                   class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-sm">
                                    📎 {{ $file->file_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($record->notes)
                    <div class="mt-4">
                        <p class="text-slate-300 text-sm font-semibold mb-1">Notes</p>
                        <p class="text-white">{{ $record->notes }}</p>
                    </div>
                @endif

            </div>
        @empty
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl text-center">
                <p class="text-white font-semibold">No medical records found.</p>
                <p class="text-slate-400 text-sm mt-1">Click “Add Record” to create one.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
