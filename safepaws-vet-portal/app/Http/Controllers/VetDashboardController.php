<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class VetDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'patients' => Patient::count(),
            'appointments' => Appointment::whereDate('time', '>=', today())->count(),
            'reports' => MedicalRecord::count(),
            'revenue' => 'Rs. 150,000',
        ];

        $branches = Branch::all();

        $appointments = Appointment::with('patient')
            ->orderBy('time', 'desc')
            ->limit(10)
            ->get();

        $reports = MedicalRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $patients = Patient::orderBy('name')->get();

        return view('dashboard', compact('stats', 'branches', 'appointments', 'reports', 'patients'));
    }
}
