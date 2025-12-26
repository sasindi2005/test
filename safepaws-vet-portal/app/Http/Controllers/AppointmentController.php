<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Pet;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['pet', 'branch'])
            ->orderBy('appointment_at', 'asc')
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $pets = Pet::orderBy('name')->get();

        return view('appointments.create', compact('branches', 'pets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'appointment_at' => ['required', 'date'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        Appointment::create($validated);

        return redirect()
            ->route('vet.appointments.index')
            ->with('success', 'Appointment created successfully!');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['pet', 'branch']);

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $branches = Branch::orderBy('name')->get();
        $pets = Pet::orderBy('name')->get();

        return view('appointments.edit', compact('appointment', 'branches', 'pets'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'appointment_at' => ['required', 'date'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('vet.appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('vet.appointments.index')
            ->with('success', 'Appointment deleted successfully!');
    }
}
