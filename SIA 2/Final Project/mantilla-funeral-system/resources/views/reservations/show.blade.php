@extends('layouts.app', ['title' => 'Reservation Details'])

@section('content')
<div class="card" style="
    background: linear-gradient(135deg, rgba(22,18,14,.95), rgba(15,12,10,.97));
    padding: 36px;
    border-radius: 28px;
    color: #f8ead2;
    animation: fadeUp 1s ease both;
">
    <h1 style="font-size:2.2rem; color:#f3d891;">Reservation Details</h1>

    <div style="margin-top:16px; line-height:1.6rem;">
        <p><strong>Reservation Code:</strong> {{ $reservation->reservation_code }}</p>
        <p><strong>Service:</strong> {{ $reservation->service->name }}</p>
        <p>
            <strong>Status:</strong> 
            <span class="badge {{ $reservation->status }}" data-status="{{ $reservation->status }}" style="
                padding:6px 12px;
                border-radius:12px;
                color: #fff;
            ">
                {{ ucfirst($reservation->status) }}
            </span>
        </p>
        <p><strong>Preferred Schedule:</strong> {{ $reservation->preferred_schedule->format('F d, Y') }}</p>
    </div>

    <h3 style="margin-top:24px; color:#f3d891;">Deceased Information</h3>
    <p><strong>Name:</strong> {{ $reservation->deceased_name }}</p>
    <p><strong>Age:</strong> {{ $reservation->deceased_age ?? 'N/A' }}</p>
    <p><strong>Date of Death:</strong> {{ optional($reservation->date_of_death)->format('F d, Y') ?? 'N/A' }}</p>

    <h3 style="margin-top:24px; color:#f3d891;">Contact Information</h3>
    <p><strong>Contact Person:</strong> {{ $reservation->contact_person }}</p>
    <p><strong>Contact Number:</strong> {{ $reservation->contact_number }}</p>

    <h3 style="margin-top:24px; color:#f3d891;">Notes</h3>
    <p>{{ $reservation->notes ?: 'No notes provided.' }}</p>

    <h3 style="margin-top:24px; color:#f3d891;">Admin Remarks</h3>
    <p>{{ $reservation->admin_remarks ?: 'No remarks yet.' }}</p>

    @if($reservation->canBeCancelled())
        <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" onsubmit="return confirm('Are you sure you want to cancel this reservation?');" style="margin-top:24px;">
            @csrf
            @method('PATCH')
            <button class="btn btn-danger" type="submit" style="
                padding:12px 24px;
                background: #e15b64;
                color: #fff;
                border-radius:12px;
                font-weight:700;
                transition: all .22s ease;
            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 28px rgba(225,91,100,.28)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                Cancel Reservation
            </button>
        </form>
    @else
        <button class="btn btn-muted" disabled style="
            padding:12px 24px;
            background: #777;
            color: #ccc;
            border-radius:12px;
            font-weight:700;
            margin-top:24px;
        ">
            Cannot Cancel
        </button>
    @endif
</div>

@push('styles')
<style>
    @keyframes fadeUp {
        0% { opacity:0; transform: translateY(18px);}
        100% { opacity:1; transform: translateY(0);}
    }
    .badge[data-status="approved"]{ background:#3cb371; }
    .badge[data-status="pending"]{ background:#f1c75d; color:#000; }
    .badge[data-status="rejected"], .badge[data-status="cancelled"]{ background:#e15b64; }
</style>
@endpush
@endsection 