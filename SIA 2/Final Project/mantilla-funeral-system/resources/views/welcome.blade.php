@extends('layouts.app', ['title' => 'Home'])

@section('content')

{{-- Hero Section --}}
<section class="card" style="background: linear-gradient(135deg, rgba(214,168,79,.18), rgba(10,10,10,.85)); border-radius: 24px; padding: 40px; text-align:center; animation: fadeUp 1s ease both;">
    <h1 style="font-size: 2.8rem; letter-spacing: 1px; color: #f8ead2;">Welcome to Mantilla Funeral Reservation System</h1>
    <p style="font-size: 1.1rem; max-width: 800px; margin: 18px auto; color: rgba(248,234,210,.78);">
        A dignified, organized, and visually rich online platform that helps families view funeral services, submit reservations,
        and monitor reservation status with elegance and clarity.
    </p>
    <a class="btn" href="{{ route('services.index') }}" style="font-size: 1.1rem; padding: 14px 22px;">View Funeral Services</a>
</section>

{{-- Animated Banner --}}
<section class="card" style="margin-top:40px; padding: 32px; border-radius: 24px; overflow:hidden; background: radial-gradient(circle at top left, rgba(214,168,79,.15), transparent 40%); animation: fadeUp 1.2s ease both;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">
        <div style="flex:1; min-width: 280px; padding:12px;">
            <h2 style="font-size:2rem; color: #f3d891; letter-spacing:.8px;">Dignified Services</h2>
            <p style="color:rgba(248,234,210,.7); font-size:1rem;">
                Our curated funeral service packages ensure that every family experiences a professional and respectful service,
                with options tailored to different needs and budgets.
            </p>
            <a class="btn" href="{{ route('services.index') }}">Browse Services</a>
        </div>
        <div style="flex:1; min-width: 280px; padding:12px; display:grid; place-items:center;">
            <span style="font-size: 6rem; color: #d6a84f; animation: floatIcon 4s ease-in-out infinite;">🕊️</span>
        </div>
    </div>
</section>

{{-- Available Services Grid --}}
<section style="margin-top: 50px;">
    <h2 style="font-size:2rem; color:#f8ead2; margin-bottom:18px;">Available Funeral Services</h2>
    <div class="grid">
        @forelse($services as $service)
        <div class="card" style="position:relative; background: linear-gradient(135deg, rgba(214,168,79,.08), rgba(15,12,10,.85)); border-radius: 24px; padding:24px; animation: fadeUp 1.2s ease both;">
            <div style="position:absolute; top:-12px; right:-12px; font-size:2rem; color: #d6a84f; opacity:.18;">✦</div>
            <h3 style="font-size:1.6rem; color:#f3d891;">{{ $service->name }}</h3>
            <p style="color: rgba(248,234,210,.72); line-height:1.5; margin: 12px 0;">
                {{ Str::limit($service->description, 160) }}
            </p>
            <p style="font-weight:800; font-size:1.2rem; color:#d6a84f;">₱{{ number_format($service->price, 2) }}</p>
            <a class="btn" href="{{ route('services.show', $service) }}">View Details</a>
        </div>
        @empty
        <div class="card" style="text-align:center; font-size:1.2rem; color:#ffd8a9;">
            No available services yet.
        </div>
        @endforelse
    </div>
</section>

{{-- Luxury Info Section --}}
<section class="card" style="margin-top:60px; padding:40px; background: radial-gradient(circle at top right, rgba(214,168,79,.12), transparent 35%); border-radius:24px; animation: fadeUp 1.4s ease both;">
    <div style="display:flex; justify-content:space-between; gap:24px; flex-wrap:wrap;">
        <div style="flex:1; min-width:260px;">
            <h2 style="color:#f3d891; font-size:1.8rem;">Why Choose Mantilla?</h2>
            <ul style="color:rgba(248,234,210,.72); margin-top:14px; line-height:1.6;">
                <li>✅ Respectful and professional service handling</li>
                <li>✅ Multiple service packages to suit family needs</li>
                <li>✅ Easy online reservations and status tracking</li>
                <li>✅ Administrative management for clarity and accountability</li>
                <li>✅ Elegant, responsive interface with visual cues and animation</li>
            </ul>
        </div>
        <div style="flex:1; min-width:260px; display:grid; place-items:center;">
            <span style="font-size: 7rem; color:#d6a84f; animation: floatIcon 5s ease-in-out infinite;">🕯️</span>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="card" style="margin-top:60px; padding: 36px; border-radius:24px; text-align:center; background: linear-gradient(135deg, rgba(214,168,79,.15), rgba(15,12,10,.88)); animation: fadeUp 1.5s ease both;">
    <h2 style="font-size:2rem; color:#f3d891;">Start Your Reservation Today</h2>
    <p style="color:rgba(248,234,210,.74); font-size:1.1rem; max-width:700px; margin:12px auto;">
        Experience a seamless and dignified way to arrange and manage funeral services online.
    </p>
    <a class="btn" href="{{ route('register') }}" style="font-size:1.1rem; padding:14px 22px;">Create Account</a>
    <a class="btn btn-muted" href="{{ route('login') }}" style="font-size:1.1rem; padding:14px 22px; margin-left:12px;">Login</a>
</section>

{{-- Animated Footer Callout --}}
<section style="margin-top:60px; padding:32px; text-align:center;">
    <p style="color: #f8ead2; font-size:1rem; animation: fadeUp 2s ease both;">
        ✨ Mantilla Funeral Reservation System - Bringing dignity, clarity, and simplicity to funeral service management. ✨
    </p>
</section>

{{-- Extra visual luxury dividers / icons for richness --}}
<div style="position:absolute; top:12%; left:4%; font-size:4rem; color: rgba(214,168,79,.08); animation: floatIcon 6s ease-in-out infinite;">✦</div>
<div style="position:absolute; bottom:10%; right:6%; font-size:5rem; color: rgba(214,168,79,.09); animation: floatIcon 5.8s ease-in-out infinite;">🕊️</div>
<div style="position:absolute; top:30%; right:12%; font-size:3rem; color: rgba(243,216,145,.07); animation: floatIcon 6.5s ease-in-out infinite;">🕯️</div>

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