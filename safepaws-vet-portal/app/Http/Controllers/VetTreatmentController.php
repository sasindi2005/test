<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\TreatmentUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VetTreatmentController extends Controller
{
    // ✅ Vet dashboard: list assigned treatments
    public function index()
    {
        $vetId = Auth::id();

        $treatments = Treatment::with('pet')
            ->where('veterinarian_id', $vetId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('vet.treatments.index', compact('treatments'));
    }

    // ✅ show single treatment + updates + update form
    public function show(Treatment $treatment)
    {
        $this->authorizeVet($treatment);

        $treatment->load(['pet', 'updates']);

        return view('vet.treatments.show', compact('treatment'));
    }

    // ✅ create update endpoint (Task 2.1 #2)
    public function storeUpdate(Request $request, Treatment $treatment)
    {
        $this->authorizeVet($treatment);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,ongoing,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'attachment' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('treatment_updates', 'public');
        }

        TreatmentUpdate::create([
            'treatment_id' => $treatment->id,
            'veterinarian_id' => Auth::id(),
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
            'attachment' => $path,
        ]);

        // ✅ update treatment status also
        $treatment->status = $validated['status'];
        if ($validated['status'] === 'completed') {
            $treatment->completed_at = now();
        }
        $treatment->save();

        return redirect()
            ->route('vet.treatments.show', $treatment)
            ->with('success', 'Treatment updated successfully.');
    }

    // ✅ validate vet permission (Task 2.1 #3)
    private function authorizeVet(Treatment $treatment): void
    {
        if ($treatment->veterinarian_id !== Auth::id()) {
            abort(403, 'You are not allowed to update this treatment.');
        }
    }
}
