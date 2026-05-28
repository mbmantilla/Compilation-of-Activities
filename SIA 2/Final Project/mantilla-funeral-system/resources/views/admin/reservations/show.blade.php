@extends('layouts.app', ['title' => 'Admin Reservation Details'])

@section('content')
<div class="card">
    <h1>Reservation Request</h1>

    <p><strong>Reservation Code:</strong> {{ $reservation->reservation_code }}</p>
    <p><strong>Status:</strong> <span class="badge {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></p>
    <p><strong>Client:</strong> {{ $reservation->client->name }} | {{ $reservation->client->email }}</p>
    <p><strong>Service:</strong> {{ $reservation->service->name }}</p>
    <p><strong>Preferred Schedule:</strong> {{ $reservation->preferred_schedule->format('F d, Y') }}</p>

    <h3>Deceased Information</h3>
    <p><strong>Name:</strong> {{ $reservation->deceased_name }}</p>
    <p><strong>Age:</strong> {{ $reservation->deceased_age ?? 'N/A' }}</p>
    <p><strong>Date of Death:</strong> {{ optional($reservation->date_of_death)->format('F d, Y') ?? 'N/A' }}</p>

    <h3>Contact Information</h3>
    <p><strong>Contact Person:</strong> {{ $reservation->contact_person }}</p>
    <p><strong>Contact Number:</strong> {{ $reservation->contact_number }}</p>

    <h3>Client Notes</h3>
    <p>{{ $reservation->notes ?: 'No notes provided.' }}</p>

    <h3>Admin Remarks</h3>
    <p>{{ $reservation->admin_remarks ?: 'No remarks yet.' }}</p>
</div>

@if($reservation->status !== 'cancelled')
<div class="grid">
    <div class="card">
        <h2>Approve Reservation</h2>
        <form method="POST" action="{{ route('admin.reservations.approve', $reservation) }}">
            @csrf
            @method('PATCH')

            <label>Remarks</label>
            <textarea name="admin_remarks" rows="4">{{ old('admin_remarks') }}</textarea>

            <br><br>
            <button class="btn" type="submit">Approve</button>
        </form>
    </div>

    <div class="card">
        <h2>Reject Reservation</h2>
        <form method="POST" action="{{ route('admin.reservations.reject', $reservation) }}">
            @csrf
            @method('PATCH')

            <label>Reason / Remarks</label>
            <textarea name="admin_remarks" rows="4" required>{{ old('admin_remarks') }}</textarea>

            <br><br>
            <button class="btn btn-danger" type="submit">Reject</button>
        </form>
    </div>
</div>
@endif
@endsection
