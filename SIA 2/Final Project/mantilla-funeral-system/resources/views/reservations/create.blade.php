@extends('layouts.app', ['title' => 'Submit Reservation'])

@section('content')

{{-- Page Header --}}
<section class="card" style="
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    padding: 36px 42px;
    background:
        radial-gradient(circle at top left, rgba(214,168,79,.22), transparent 36%),
        linear-gradient(135deg, rgba(15,12,10,.94), rgba(5,5,5,.95));
    animation: fadeUp 1s ease both;
">
    <h1 style="font-size:2.6rem; color:#f8ead2; letter-spacing:1px;">Submit Reservation</h1>
    <p style="color: rgba(248,234,210,.78); font-size:1.1rem; margin-top:12px;">
        Complete the form below to reserve the selected funeral service package. Your reservation will be reviewed by our staff promptly.
    </p>

    {{-- Decorative Icon --}}
    <div style="position:absolute; top:-20px; right:-10px; font-size:8rem; color:rgba(214,168,79,.08); animation: floatIcon 6s ease-in-out infinite;">
        🕊️
    </div>
</section>

{{-- Selected Service Summary --}}
<section class="card" style="
    margin-top:32px;
    padding:28px 36px;
    border-radius:24px;
    background: linear-gradient(135deg, rgba(214,168,79,.08), rgba(15,12,10,.88));
    animation: fadeUp 1.1s ease both;
">
    <h2 style="color:#f3d891; font-size:2rem;">Selected Service</h2>
    <p style="color:rgba(248,234,210,.75); font-size:1.05rem;">{{ $service->name }}</p>
    <p style="font-weight:700; color:#f8ead2;">Price: ₱{{ number_format($service->price, 2) }}</p>
    <span class="badge {{ $service->availability_status }}" style="margin-top:8px; padding:6px 12px;">
        {{ ucfirst($service->availability_status) }}
    </span>
</section>

{{-- Reservation Form --}}
<section class="card" style="
    margin-top:36px;
    padding:36px 42px;
    border-radius:28px;
    background:
        radial-gradient(circle at top right, rgba(214,168,79,.12), transparent 35%),
        linear-gradient(135deg, rgba(22,18,14,.9), rgba(8,8,8,.92));
    animation: fadeUp 1.2s ease both;
">
    <form method="POST" action="{{ route('reservations.store', $service) }}">
        @csrf

        {{-- Deceased Name --}}
        <label>Name of Deceased</label>
        <input type="text" name="deceased_name" value="{{ old('deceased_name') }}" required placeholder="Enter full name">

        {{-- Age --}}
        <label>Age of Deceased</label>
        <input type="number" name="deceased_age" value="{{ old('deceased_age') }}" placeholder="Optional">

        {{-- Date of Death --}}
        <label>Date of Death</label>
        <input type="date" name="date_of_death" value="{{ old('date_of_death') }}" placeholder="YYYY-MM-DD">

        {{-- Preferred Schedule --}}
        <label>Preferred Schedule</label>
        <input type="date" name="preferred_schedule" value="{{ old('preferred_schedule') }}" required>

        {{-- Contact Person --}}
        <label>Contact Person</label>
        <input type="text" name="contact_person" value="{{ old('contact_person', auth()->user()->name) }}" required placeholder="Your name">

        {{-- Contact Number --}}
        <label>Contact Number</label>
        <input type="text" name="contact_number" value="{{ old('contact_number', auth()->user()->phone) }}" required placeholder="09123456789">

        {{-- Additional Notes --}}
        <label>Additional Notes</label>
        <textarea name="notes" rows="5" placeholder="Optional notes">{{ old('notes') }}</textarea>

        <div style="margin-top:28px; display:flex; gap:14px; flex-wrap:wrap;">
            <button type="submit" class="btn" style="font-size:1.1rem; padding:14px 20px;">
                📝 Submit Reservation
            </button>
            <a href="{{ route('services.show', $service) }}" class="btn btn-muted" style="font-size:1.1rem; padding:14px 20px;">
                ← Back to Service
            </a>
        </div>
    </form>
</section>

{{-- Floating Decorative Icons --}}
<div style="position:absolute; top:15%; left:6%; font-size:4rem; color:rgba(214,168,79,.07); animation: floatIcon 6s ease-in-out infinite;">✦</div>
<div style="position:absolute; bottom:10%; right:7%; font-size:5rem; color:rgba(214,168,79,.07); animation: floatIcon 5.8s ease-in-out infinite;">🕯️</div>

@push('styles')
<style>
    @keyframes floatIcon {
        0%,100% { transform: translateY(0) rotate(0deg);}
        50% { transform: translateY(-12px) rotate(8deg);}
    }

    @keyframes fadeUp {
        0% { opacity:0; transform: translateY(18px);}
        100% { opacity:1; transform: translateY(0);}
    }

    input, textarea {
        background: rgba(255,255,255,.045);
        color: #f8ead2;
        border:1px solid rgba(214,168,79,.22);
        border-radius:14px;
        padding:12px 14px;
        margin-top:6px;
        font-size:1rem;
        transition: border-color .22s ease, box-shadow .22s ease, background .22s ease;
    }

    input:focus, textarea:focus {
        border-color: rgba(243,216,145,.65);
        box-shadow:0 0 0 4px rgba(214,168,79,.12);
        background: rgba(255,255,255,.07);
        outline:none;
    }

    textarea { resize: vertical; }

    label {
        color: #f3d891;
        font-weight:700;
        margin-top:14px;
        display:block;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 38px rgba(214,168,79,.28);
        filter: brightness(1.05);
    }
</style>
@endpush

@endsection