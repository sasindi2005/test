<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'title' => 'required|string|max:255',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'prescription' => 'nullable|array',
            'prescription.*' => 'string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('medical-records', 'public');
        }

        MedicalRecord::create([
            'patient_id' => $validated['patient_id'],
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'symptoms' => $validated['symptoms'] ?? null,
            'diagnosis' => $validated['diagnosis'] ?? null,
            'prescription' => $validated['prescription'] ?? null,
            'file_path' => $filePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Medical record added successfully!');
    }
}
