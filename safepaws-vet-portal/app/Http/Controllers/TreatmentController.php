<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        // ✅ shows ongoing treatments (with pet + owner)
        $treatments = Treatment::with(['pet.owner'])
            ->latest()
            ->paginate(10);

        return view('treatments.index', compact('treatments'));
    }

    public function updateStatus(Request $request, Treatment $treatment)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:ongoing,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $treatment->update([
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? $treatment->notes,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Treatment status updated successfully!');
    }
}
