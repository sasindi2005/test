<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\MedicalRecordFile;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function history(Pet $pet)
    {
        $records = MedicalRecord::with(['vet', 'files'])
            ->where('pet_id', $pet->id)
            ->latest()
            ->get();

        return view('vet.medical.history', compact('pet', 'records'));
    }

    public function create(Pet $pet)
    {
        return view('vet.medical.create', compact('pet'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
            'symptoms' => ['required', 'string', 'max:2000'],
            'diagnosis' => ['required', 'string', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:2000'],

            // Prescription JSON inputs
            'prescription.*.medicine' => ['required', 'string', 'max:255'],
            'prescription.*.dose' => ['required', 'string', 'max:255'],
            'prescription.*.duration' => ['required', 'string', 'max:255'],

            // Files
            'attachments.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'], // 5MB each
        ]);

        $record = MedicalRecord::create([
            'pet_id' => $validated['pet_id'],
            'vet_id' => auth()->id() ?? 1, // ✅ if not using auth yet, keep 1
            'symptoms' => $validated['symptoms'],
            'diagnosis' => $validated['diagnosis'],
            'prescription' => $request->input('prescription', []),
            'notes' => $validated['notes'] ?? null,
        ]);

        // ✅ Store attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {

                $path = $file->store('medical_records', 'public');

                MedicalRecordFile::create([
                    'medical_record_id' => $record->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()
            ->route('medical.history', $record->pet_id)
            ->with('success', 'Medical record added successfully!');
    }

    public function download(MedicalRecordFile $file)
    {
        return Storage::disk('public')->download($file->file_path, $file->file_name);
    }
}
