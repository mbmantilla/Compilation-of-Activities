@extends('layouts.app', ['title' => 'Client Dashboard'])

@section('content')

{{-- Dashboard Header --}}
<section class="card" style="background: linear-gradient(135deg, rgba(214,168,79,.18), rgba(10,10,10,.88)); border-radius: 24px; padding: 36px; text-align:center; animation: fadeUp 1s ease both;">
    <h1 style="font-size:2.8rem; color:#f8ead2; letter-spacing:1px;">Welcome, {{ auth()->user()->name }}</h1>
    <p style="color: rgba(248,234,210,.78); font-size:1.2rem; margin-top:12px;">
        Your personalized client dashboard. Track your funeral service reservations and status at a glance.
    </p>
</section>

{{-- Reservation Summary Cards --}}
<section style="margin-top: 32px; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:18px;">
    @foreach (['total', 'pending', 'approved', 'cancelled'] as $key)
        <div class="card" style="padding:24px; border-radius:24px; background: linear-gradient(135deg, rgba(214,168,79,.08), rgba(15,12,10,.85)); animation: fadeUp .9s ease both;">
            <h3 style="font-size:1.5rem; color:#f3d891; margin-top:12px;">{{ ucfirst($key) }}</h3>
            <p style="font-size:1.8rem; font-weight:800; color:#f8ead2;">{{ $counts[$key] ?? 0 }}</p>
        </div>
    @endforeach
</section>

{{-- Additional Metrics Cards --}}
<section style="margin-top:50px;">
    <div class="grid">
        <div class="card" style="padding:28px; border-radius:24px; background: radial-gradient(circle at top left, rgba(214,168,79,.12), transparent 40%); animation: fadeUp 1.3s ease both;">
            <h3 style="font-size:1.6rem; color:#f3d891;">Upcoming Reservations</h3>
            <p style="font-size:1.4rem; color:#f8ead2;">{{ $counts['upcoming'] ?? 0 }}</p>
        </div>

        <div class="card" style="padding:28px; border-radius:24px; background: radial-gradient(circle at top right, rgba(101,214,158,.15), transparent 40%); animation: fadeUp 1.4s ease both;">
            <h3 style="font-size:1.6rem; color:#f3d891;">Last Month Approved</h3>
            <p style="font-size:1.4rem; color:#f8ead2;">{{ $counts['approved_last_month'] ?? 0 }}</p>
        </div>

        <div class="card" style="padding:28px; border-radius:24px; background: radial-gradient(circle at bottom left, rgba(241,199,93,.12), transparent 40%); animation: fadeUp 1.5s ease both;">
            <h3 style="font-size:1.6rem; color:#f3d891;">Cancellations</h3>
            <p style="font-size:1.4rem; color:#f8ead2;">{{ $counts['cancelled_last_month'] ?? 0 }}</p>
        </div>

        <div class="card" style="padding:28px; border-radius:24px; background: radial-gradient(circle at bottom right, rgba(225,91,100,.15), transparent 40%); animation: fadeUp 1.6s ease both;">
            <h3 style="font-size:1.6rem; color:#f3d891;">Pending Requests</h3>
            <p style="font-size:1.4rem; color:#f8ead2;">{{ $counts['pending_last_month'] ?? 0 }}</p>
        </div>
    </div>
</section>

{{-- Recent Reservations --}}
<section style="margin-top: 50px;">
    <div class="card" style="padding:28px; border-radius:24px; background: linear-gradient(135deg, rgba(214,168,79,.08), rgba(15,12,10,.88)); animation: fadeUp 1.2s ease both;">
        <h2 style="color:#f3d891; font-size:2rem; margin-bottom:20px;">Recent Reservations</h2>
        @include('partials.reservation-table', ['reservations' => $reservations, 'clientView' => true])
    </div>
</section>

{{-- CTA Section --}}
<section class="card" style="margin-top:60px; padding:36px; border-radius:24px; text-align:center; background: linear-gradient(135deg, rgba(214,168,79,.15), rgba(10,10,10,.88)); animation: fadeUp 1.6s ease both;">
    <h2 style="font-size:2rem; color:#f3d891;">Need to make a new reservation?</h2>
    <p style="color: rgba(248,234,210,.72); font-size:1.1rem; max-width:700px; margin:12px auto;">
        Arrange and manage funeral services seamlessly with a few clicks.
    </p>
    <a class="btn" href="{{ route('services.index') }}">Reserve Service</a>
</section>

{{-- Decorative Floating Icons --}}
<div style="position:absolute; top:12%; left:5%; font-size:4rem; color: rgba(214,168,79,.08); animation: floatIcon 6s ease-in-out infinite;">✦</div>
<div style="position:absolute; bottom:10%; right:5%; font-size:5rem; color: rgba(214,168,79,.08); animation: floatIcon 5.8s ease-in-out infinite;">🕊️</div>
<div style="position:absolute; top:35%; right:10%; font-size:3rem; color: rgba(243,216,145,.07); animation: floatIcon 6.5s ease-in-out infinite;">🕯️</div>

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
</style>
@endpush

@endsection