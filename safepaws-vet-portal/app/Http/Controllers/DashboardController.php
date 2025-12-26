<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Consultation;
use App\Models\Owner;
use App\Models\Pet;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pets' => Pet::count(),
            'owners' => Owner::count(),
            'branches' => Branch::count(),
            'revenue_today' => Consultation::whereDate('created_at', now())->sum('total_cost'),
        ];

        $todayAppointments = Appointment::with(['pet.owner', 'branch'])
            ->whereDate('appointment_at', now())
            ->orderBy('appointment_at')
            ->take(8)
            ->get();

        $last7Days = collect(range(6, 0))->map(function ($i) {
            $date = now()->subDays($i);

            return [
                'date' => $date->format('D'),
                'total' => Consultation::whereDate('created_at', $date)->sum('total_cost'),
            ];
        });

        return view('dashboard.index', compact('stats', 'todayAppointments', 'last7Days'));
    }
}
