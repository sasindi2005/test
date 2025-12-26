@extends('layouts.vet')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Add Medical Record</h1>
        <a href="{{ route('medical.history', $pet->id) }}"
           class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white text-sm">
            ← Back
        </a>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl">
        <form method="POST" action="{{ route('medical.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="pet_id" value="{{ $pet->id }}">

            <!-- Symptoms -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-200 mb-2">Symptoms</label>
                <textarea name="symptoms" rows="3"
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white p-3 focus:ring focus:ring-sky-500/30"
                    required>{{ old('symptoms') }}</textarea>
                @error('symptoms') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Diagnosis -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-200 mb-2">Diagnosis</label>
                <textarea name="diagnosis" rows="3"
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white p-3 focus:ring focus:ring-sky-500/30"
                    required>{{ old('diagnosis') }}</textarea>
                @error('diagnosis') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Prescription -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-slate-200">Prescription</label>
                    <button type="button" onclick="addMedicineRow()"
                        class="text-sm px-3 py-1.5 rounded-lg bg-sky-500 hover:bg-sky-400 font-semibold">
                        + Add Medicine
                    </button>
                </div>

                <div id="prescriptionRows" class="space-y-3">
                    <!-- Default Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-3 rounded-xl bg-white/5 border border-white/10">
                        <input name="prescription[0][medicine]" placeholder="Medicine"
                               class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>

                        <input name="prescription[0][dose]" placeholder="Dose (e.g 100mg)"
                               class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>

                        <input name="prescription[0][duration]" placeholder="Duration (e.g 7 days)"
                               class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-200 mb-2">Notes (optional)</label>
                <textarea name="notes" rows="2"
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white p-3 focus:ring focus:ring-sky-500/30">{{ old('notes') }}</textarea>
            </div>

            <!-- Upload -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-200 mb-2">Upload Reports / Images</label>
                <input type="file" name="attachments[]" multiple
                       accept=".jpg,.jpeg,.png,.pdf"
                       class="w-full text-white text-sm file:bg-white/10 file:border-0 file:px-4 file:py-2 file:rounded-lg file:text-white hover:file:bg-white/20">

                <p class="text-xs text-slate-400 mt-2">Allowed: JPG, PNG, PDF (max 5MB each)</p>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-bold transition">
                Save Medical Record
            </button>

        </form>
    </div>
</div>

<script>
let rowIndex = 1;

function addMedicineRow() {
    const container = document.getElementById('prescriptionRows');

    const row = document.createElement('div');
    row.className = "grid grid-cols-1 sm:grid-cols-3 gap-3 p-3 rounded-xl bg-white/5 border border-white/10 relative";

    row.innerHTML = `
        <input name="prescription[${rowIndex}][medicine]" placeholder="Medicine"
            class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>

        <input name="prescription[${rowIndex}][dose]" placeholder="Dose"
            class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>

        <input name="prescription[${rowIndex}][duration]" placeholder="Duration"
            class="w-full rounded-lg bg-black/20 border border-white/10 text-white p-2" required>
    `;

    container.appendChild(row);
    rowIndex++;
}
</script>
@endsection
