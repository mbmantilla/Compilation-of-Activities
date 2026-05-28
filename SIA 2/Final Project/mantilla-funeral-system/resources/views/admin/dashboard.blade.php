@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')

{{-- Dashboard Header --}}
<section class="card" style="padding:36px 42px; border-radius:28px; background: linear-gradient(135deg, rgba(214,168,79,.18), rgba(10,10,10,.88)); animation: fadeUp 1s ease both;">
    <h1 style="font-size:2.6rem; color:#f8ead2;">Admin Dashboard</h1>
    <p style="color: rgba(248,234,210,.78); font-size:1.1rem; margin-top:12px;">
        Overview of services, clients, and reservations with key metrics and analytics.
    </p>
</section>

{{-- Key Metrics Cards --}}
<section style="margin-top:32px; display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:18px;">
    <div class="card" style="padding:24px; border-radius:24px; animation: fadeUp 1.1s ease both;">
        <h3 style="color:#f3d891;">Services</h3>
        <p style="color:#f8ead2; font-size:1.5rem;">{{ $counts['services'] }}</p>
    </div>
    <div class="card" style="padding:24px; border-radius:24px; animation: fadeUp 1.2s ease both;">
        <h3 style="color:#f3d891;">Available Services</h3>
        <p style="color:#f8ead2; font-size:1.5rem;">{{ $counts['available_services'] }}</p>
    </div>
    <div class="card" style="padding:24px; border-radius:24px; animation: fadeUp 1.3s ease both;">
        <h3 style="color:#f3d891;">Clients</h3>
        <p style="color:#f8ead2; font-size:1.5rem;">{{ $counts['clients'] }}</p>
    </div>
    <div class="card" style="padding:24px; border-radius:24px; animation: fadeUp 1.4s ease both;">
        <h3 style="color:#f3d891;">Pending Reservations</h3>
        <p style="color:#f8ead2; font-size:1.5rem;">{{ $counts['pending_reservations'] }}</p>
    </div>
</section>

{{-- Admin Shortcuts --}}
<section class="card" style="margin-top:32px; padding:28px; border-radius:28px; animation: fadeUp 1.5s ease both;">
    <h2 style="color:#f3d891;">Admin Shortcuts</h2>
    <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:14px;">
        <a class="btn" href="{{ route('admin.services.index') }}">Manage Services</a>
        <a class="btn" href="{{ route('admin.reservations.index') }}">Reservation Requests</a>
        <a class="btn" href="{{ route('admin.clients.index') }}">Client Records</a>
        <a class="btn" href="{{ route('admin.reports.index') }}">Reports</a>
    </div>
</section>

{{-- Recent Reservations --}}
<section class="card" style="margin-top:32px; padding:28px; border-radius:28px; animation: fadeUp 1.6s ease both;">
    <h2 style="color:#f3d891;">Recent Reservations</h2>
    @include('partials.reservation-table', ['reservations' => $recentReservations, 'clientView' => false])
</section>

{{-- Charts Section --}}
<section class="card" style="margin-top:36px; padding:28px; border-radius:28px; animation: fadeUp 1.7s ease both;">
    <h2 style="color:#f3d891;">Analytics & Key Metrics</h2>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px; margin-top:18px;">

        {{-- Reservations by Status Chart --}}
        <div style="background: rgba(255,255,255,.03); padding:16px; border-radius:18px;">
            <h3 style="color:#f3d891;">Reservations by Status</h3>
            <canvas id="reservationsStatusChart" height="250"></canvas>
        </div>

        {{-- Monthly Reservations Chart --}}
        <div style="background: rgba(255,255,255,.03); padding:16px; border-radius:18px;">
            <h3 style="color:#f3d891;">Monthly Reservations</h3>
            <canvas id="monthlyReservationsChart" height="250"></canvas>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Reservations by Status Chart
    const ctxStatus = document.getElementById('reservationsStatusChart').getContext('2d');
    const reservationsStatusChart = new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Cancelled'],
            datasets: [{
                label: 'Reservations Status',
                data: [
                    {{ $analytics['pending'] ?? 0 }},
                    {{ $analytics['approved'] ?? 0 }},
                    {{ $analytics['cancelled'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(241,199,93,0.6)',
                    'rgba(101,214,158,0.6)',
                    'rgba(225,91,100,0.6)'
                ],
                borderColor: [
                    'rgba(241,199,93,1)',
                    'rgba(101,214,158,1)',
                    'rgba(225,91,100,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { color: '#f3d891' } }
            }
        }
    });

    // Monthly Reservations Chart
    const ctxMonthly = document.getElementById('monthlyReservationsChart').getContext('2d');
    const monthlyReservationsChart = new Chart(ctxMonthly, {
        type: 'bar',
        data: {
            labels: {!! json_encode($analytics['months'] ?? []) !!},
            datasets: [{
                label: 'Reservations',
                data: {!! json_encode($analytics['monthly_counts'] ?? []) !!},
                backgroundColor: 'rgba(214,168,79,0.6)',
                borderColor: 'rgba(214,168,79,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { ticks: { color: '#f3d891' }, grid: { color: 'rgba(255,255,255,0.05)' } },
                y: { ticks: { color: '#f3d891' }, grid: { color: 'rgba(255,255,255,0.05)' } }
            }
        }
    });
</script>
@endpush

@endsection