@extends('layouts.app', ['title' => 'Reports'])

@section('content')
<h1>System Reports</h1>

<div class="card">
    <a class="btn" href="{{ route('admin.reports.reservations.csv') }}">Download Reservation CSV</a>
</div>

<div class="grid">
    <div class="card"><h3>Total Clients</h3><p>{{ $summary['total_clients'] }}</p></div>
    <div class="card"><h3>Total Services</h3><p>{{ $summary['total_services'] }}</p></div>
    <div class="card"><h3>Total Reservations</h3><p>{{ $summary['total_reservations'] }}</p></div>
    <div class="card"><h3>Estimated Revenue</h3><p>₱{{ number_format($summary['estimated_revenue'], 2) }}</p></div>
</div>

<div class="grid">
    <div class="card"><h3>Pending</h3><p>{{ $summary['pending'] }}</p></div>
    <div class="card"><h3>Approved</h3><p>{{ $summary['approved'] }}</p></div>
    <div class="card"><h3>Rejected</h3><p>{{ $summary['rejected'] }}</p></div>
    <div class="card"><h3>Cancelled</h3><p>{{ $summary['cancelled'] }}</p></div>
</div>

<div class="card">
    <h2>Reservations by Service</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Reservations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservationsByService as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->reservations_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
