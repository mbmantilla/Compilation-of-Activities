@extends('layouts.app', ['title' => $service->name])

@section('content')

<section class="card" style="
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    padding: 42px;
    background:
        radial-gradient(circle at top left, rgba(214,168,79,.22), transparent 36%),
        linear-gradient(135deg, rgba(15,12,10,.94), rgba(5,5,5,.95));
    animation: fadeUp .9s ease both;
">
    <div style="position:absolute; top:-40px; right:-30px; font-size:9rem; color:rgba(214,168,79,.08); animation: floatIcon 6s ease-in-out infinite;">
        🕊️
    </div>

    <p style="color:#d6a84f; font-weight:800; letter-spacing:2px; text-transform:uppercase; margin:0 0 10px;">
        Funeral Service Package
    </p>

    <h1 style="font-size:clamp(2rem, 5vw, 4rem); color:#f8ead2; margin:0 0 16px;">
        {{ $service->name }}
    </h1>

    <p style="max-width:850px; color:rgba(248,234,210,.75); font-size:1.1rem; line-height:1.8;">
        {{ $service->description }}
    </p>

    <div style="display:flex; gap:14px; flex-wrap:wrap; margin-top:24px;">
        <div style="
            padding:16px 20px;
            border-radius:18px;
            background:rgba(214,168,79,.12);
            border:1px solid rgba(214,168,79,.24);
        ">
            <span style="display:block; color:rgba(248,234,210,.65); font-size:.85rem;">Package Price</span>
            <strong style="font-size:1.7rem; color:#f3d891;">₱{{ number_format($service->price, 2) }}</strong>
        </div>

        <div style="
            padding:16px 20px;
            border-radius:18px;
            background:rgba(255,255,255,.04);
            border:1px solid rgba(214,168,79,.24);
        ">
            <span style="display:block; color:rgba(248,234,210,.65); font-size:.85rem;">Availability</span>
            <span class="badge {{ $service->availability_status }}" style="margin-top:7px;">
                {{ ucfirst($service->availability_status) }}
            </span>
        </div>
    </div>

    <div style="margin-top:30px; display:flex; gap:12px; flex-wrap:wrap;">
        @auth
            @if(auth()->user()->role === 'client' && $service->availability_status === 'available')
                <a class="btn" href="{{ route('reservations.create', $service) }}">
                    <span>📝</span>
                    <span>Reserve This Service</span>
                </a>
            @elseif(auth()->user()->role === 'admin')
                <a class="btn" href="{{ route('admin.services.edit', $service) }}">
                    <span>⚙️</span>
                    <span>Edit Service</span>
                </a>
            @endif
        @else
            <a class="btn" href="{{ route('login') }}">
                <span>🔐</span>
                <span>Login to Reserve</span>
            </a>

            <a class="btn btn-muted" href="{{ route('register') }}">
                <span>✨</span>
                <span>Create Account</span>
            </a>
        @endauth

        <a class="btn btn-muted" href="{{ route('services.index') }}">
            <span>←</span>
            <span>Back to Services</span>
        </a>
    </div>
</section>

<section style="margin-top:34px; display:grid; grid-template-columns:1.2fr .8fr; gap:22px;">
    <div class="card" style="
        border-radius:26px;
        padding:30px;
        background:
            radial-gradient(circle at top right, rgba(214,168,79,.14), transparent 35%),
            linear-gradient(135deg, rgba(22,18,14,.9), rgba(8,8,8,.92));
        animation: fadeUp 1.1s ease both;
    ">
        <h2 style="color:#f3d891; font-size:2rem; margin-top:0;">
            ✦ Service Description
        </h2>

        <p style="color:rgba(248,234,210,.76); line-height:1.9; font-size:1.05rem;">
            {{ $service->description }}
        </p>
    </div>

    <div class="card" style="
        border-radius:26px;
        padding:30px;
        background:
            radial-gradient(circle at bottom left, rgba(214,168,79,.14), transparent 35%),
            linear-gradient(135deg, rgba(22,18,14,.9), rgba(8,8,8,.92));
        animation: fadeUp 1.2s ease both;
    ">
        <h2 style="color:#f3d891; font-size:2rem; margin-top:0;">
            🕯️ Package Summary
        </h2>

        <div style="display:grid; gap:14px;">
            <div style="padding:14px; border-radius:16px; background:rgba(255,255,255,.04); border:1px solid rgba(214,168,79,.18);">
                <strong style="color:#f8ead2;">Service Name</strong>
                <p style="margin:6px 0 0; color:rgba(248,234,210,.68);">{{ $service->name }}</p>
            </div>

            <div style="padding:14px; border-radius:16px; background:rgba(255,255,255,.04); border:1px solid rgba(214,168,79,.18);">
                <strong style="color:#f8ead2;">Price</strong>
                <p style="margin:6px 0 0; color:#f3d891; font-size:1.2rem;">₱{{ number_format($service->price, 2) }}</p>
            </div>

            <div style="padding:14px; border-radius:16px; background:rgba(255,255,255,.04); border:1px solid rgba(214,168,79,.18);">
                <strong style="color:#f8ead2;">Current Status</strong>
                <p style="margin:8px 0 0;">
                    <span class="badge {{ $service->availability_status }}">
                        {{ ucfirst($service->availability_status) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="card" style="
    margin-top:34px;
    border-radius:26px;
    padding:34px;
    background:
        radial-gradient(circle at top left, rgba(214,168,79,.15), transparent 32%),
        linear-gradient(135deg, rgba(18,15,12,.92), rgba(7,7,7,.95));
    animation: fadeUp 1.3s ease both;
">
    <h2 style="color:#f3d891; font-size:2rem; margin-top:0;">
        ✨ Package Inclusions
    </h2>

    @if($service->inclusions)
        <div style="display:grid; gap:12px; margin-top:18px;">
            @foreach(preg_split('/\r\n|\r|\n/', $service->inclusions) as $inclusion)
                @if(trim($inclusion) !== '')
                    <div style="
                        display:flex;
                        align-items:flex-start;
                        gap:12px;
                        padding:15px 16px;
                        border-radius:18px;
                        background:rgba(255,255,255,.045);
                        border:1px solid rgba(214,168,79,.18);
                        transition:.25s ease;
                    ">
                        <span style="
                            width:32px;
                            height:32px;
                            flex:0 0 32px;
                            border-radius:12px;
                            display:grid;
                            place-items:center;
                            color:#120d08;
                            background:linear-gradient(135deg, #f3d891, #d6a84f);
                            font-weight:900;
                        ">✓</span>

                        <span style="color:rgba(248,234,210,.78); line-height:1.6;">
                            {{ trim($inclusion) }}
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div style="
            margin-top:18px;
            padding:20px;
            border-radius:18px;
            background:rgba(255,255,255,.045);
            border:1px solid rgba(214,168,79,.18);
            color:rgba(248,234,210,.72);
        ">
            No inclusions listed.
        </div>
    @endif
</section>

<section style="margin-top:34px; display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:18px;">
    <div class="card" style="border-radius:24px; padding:24px; text-align:center; animation: fadeUp 1.4s ease both;">
        <div style="font-size:2.4rem; animation: floatIcon 4s ease-in-out infinite;">📋</div>
        <h3 style="color:#f3d891;">Step 1</h3>
        <p style="color:rgba(248,234,210,.7);">Review the selected funeral service package.</p>
    </div>

    <div class="card" style="border-radius:24px; padding:24px; text-align:center; animation: fadeUp 1.5s ease both;">
        <div style="font-size:2.4rem; animation: floatIcon 4.4s ease-in-out infinite;">📝</div>
        <h3 style="color:#f3d891;">Step 2</h3>
        <p style="color:rgba(248,234,210,.7);">Submit the reservation form with complete details.</p>
    </div>

    <div class="card" style="border-radius:24px; padding:24px; text-align:center; animation: fadeUp 1.6s ease both;">
        <div style="font-size:2.4rem; animation: floatIcon 4.8s ease-in-out infinite;">⏳</div>
        <h3 style="color:#f3d891;">Step 3</h3>
        <p style="color:rgba(248,234,210,.7);">Wait for admin review and approval.</p>
    </div>

    <div class="card" style="border-radius:24px; padding:24px; text-align:center; animation: fadeUp 1.7s ease both;">
        <div style="font-size:2.4rem; animation: floatIcon 5.2s ease-in-out infinite;">✅</div>
        <h3 style="color:#f3d891;">Step 4</h3>
        <p style="color:rgba(248,234,210,.7);">Check your reservation status from your dashboard.</p>
    </div>
</section>

<section class="card" style="
    margin-top:34px;
    text-align:center;
    border-radius:28px;
    padding:38px;
    background:
        radial-gradient(circle at center, rgba(214,168,79,.16), transparent 45%),
        linear-gradient(135deg, rgba(18,15,12,.94), rgba(5,5,5,.95));
    animation: fadeUp 1.8s ease both;
">
    <h2 style="color:#f3d891; font-size:2rem; margin-top:0;">
        Ready to continue?
    </h2>

    <p style="max-width:680px; margin:12px auto 24px; color:rgba(248,234,210,.72); line-height:1.8;">
        This online reservation process helps families organize service requests clearly,
        respectfully, and conveniently.
    </p>

    @auth
        @if(auth()->user()->role === 'client' && $service->availability_status === 'available')
            <a class="btn" href="{{ route('reservations.create', $service) }}">
                📝 Reserve This Service
            </a>
        @elseif($service->availability_status !== 'available')
            <span class="badge unavailable">This service is currently unavailable</span>
        @endif
    @else
        <a class="btn" href="{{ route('login') }}">🔐 Login to Reserve</a>
    @endauth
</section>

<div style="position:absolute; top:16%; left:4%; font-size:4rem; color:rgba(214,168,79,.07); animation: floatIcon 6s ease-in-out infinite;">✦</div>
<div style="position:absolute; bottom:12%; right:5%; font-size:5rem; color:rgba(214,168,79,.07); animation: floatIcon 5.8s ease-in-out infinite;">🕊️</div>
<div style="position:absolute; top:38%; right:8%; font-size:3rem; color:rgba(243,216,145,.07); animation: floatIcon 6.5s ease-in-out infinite;">🕯️</div>

@push('styles')
<style>
    @keyframes floatIcon {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-12px) rotate(7deg);
        }
    }

    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(18px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 42px rgba(214,168,79,.18);
        transition: transform .28s ease, box-shadow .28s ease;
    }

    @media (max-width: 900px) {
        section[style*="grid-template-columns:1.2fr .8fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@endsection