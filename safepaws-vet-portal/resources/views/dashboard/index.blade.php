@extends('layouts.vet')

@section('content')
<div class="dashboard-header">
    <h1>Dashboard</h1>
    <p class="text-muted">Overview of today's system performance</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-4 gap-4 mt-6">
    <div class="stat-card">
        <h3>Total Pets</h3>
        <p class="stat-value">{{ $stats['pets'] }}</p>
    </div>

    <div class="stat-card">
        <h3>Total Owners</h3>
        <p class="stat-value">{{ $stats['owners'] }}</p>
    </div>

    <div class="stat-card">
        <h3>Branches</h3>
        <p class="stat-value">{{ $stats['branches'] }}</p>
    </div>

    <div class="stat-card">
        <h3>Revenue Today</h3>
        <p class="stat-value">Rs. {{ number_format($stats['revenue_today'], 2) }}</p>
    </div>
</div>

{{-- Today Appointments --}}
<div class="card mt-8">
    <h2 class="card-title">Today's Appointments</h2>

    @if($todayAppointments->count())
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Pet</th>
                    <th>Owner</th>
                    <th>Branch</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todayAppointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_at)->format('h:i A') }}</td>
                        <td>{{ $appointment->pet->name ?? '-' }}</td>
                        <td>{{ $appointment->pet->owner->name ?? '-' }}</td>
                        <td>{{ $appointment->branch->name ?? '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $appointment->status }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted mt-3">No appointments scheduled for today.</p>
    @endif
</div>

{{-- Revenue Chart --}}
<div class="card mt-8">
    <h2 class="card-title">Revenue (Last 7 Days)</h2>

    <canvas id="revenueChart" height="100"></canvas>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const revenueData = @json($last7Days);

    const ctx = document.getElementById('revenueChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(item => item.date),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(item => item.total),
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            }
        }
    });
</script>
@endsection
