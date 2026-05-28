@extends('layouts.app', ['title' => 'Funeral Services'])

@section('content')

{{-- Page Header --}}
<section class="card" style="background: linear-gradient(135deg, rgba(214,168,79,.18), rgba(10,10,10,.88)); border-radius:24px; padding:36px; text-align:center; animation: fadeUp 1s ease both;">
    <h1 style="font-size:2.6rem; color:#f8ead2; letter-spacing:1px;">Available Funeral Services</h1>
    <p style="color: rgba(248,234,210,.78); font-size:1.1rem; margin-top:12px;">
        Explore our curated funeral service packages, designed for dignity, clarity, and ease of online reservation.
    </p>
</section>

{{-- Services Grid --}}
<section style="margin-top:40px;">
    <div class="grid">
        @forelse($services as $service)
        <div class="card" style="position:relative; border-radius:24px; padding:28px; background: linear-gradient(135deg, rgba(214,168,79,.08), rgba(15,12,10,.88)); animation: fadeUp 1.2s ease both;">
            {{-- Decorative Icon --}}
            <div style="position:absolute; top:-12px; right:-12px; font-size:2rem; color: rgba(214,168,79,.18);">✦</div>

            {{-- Service Name --}}
            <h3 style="font-size:1.6rem; color:#f3d891; margin-bottom:12px;">{{ $service->name }}</h3>

            {{-- Service Description --}}
            <p style="color: rgba(248,234,210,.72); line-height:1.6; margin-bottom:12px;">
                {{ Str::limit($service->description, 180) }}
            </p>

            {{-- Service Price --}}
            <p style="font-weight:700; font-size:1.2rem; color:#f8ead2; margin-bottom:10px;">
                Price: ₱{{ number_format($service->price, 2) }}
            </p>

            {{-- Availability Badge --}}
            <span class="badge {{ $service->availability_status }}"
                  style="display:inline-block; padding:6px 12px; font-weight:700; border-radius:12px;
                         background: {{ $service->availability_status=='available'?'rgba(101,214,158,.15)':($service->availability_status=='pending'?'rgba(241,199,93,.16)':'rgba(225,91,100,.15)') }};
                         color: {{ $service->availability_status=='available'?'#b7ffd6':($service->availability_status=='pending'?'#ffe9a9':'#ffc4c8') }};
                         border:1px solid rgba(255,255,255,.08);
                         box-shadow:0 8px 20px rgba(0,0,0,.22);">
                {{ ucfirst($service->availability_status) }}
            </span>

            {{-- View Details Button --}}
            <div style="margin-top:18px;">
                <a class="btn" href="{{ route('services.show', $service) }}"
                   style="background: linear-gradient(135deg, #d6a84f, #f3d891, #8b6425);
                          color:#120d08; font-weight:700; padding:12px 18px; border-radius:999px;
                          display:inline-flex; align-items:center; gap:8px; transition: transform .22s ease, box-shadow .22s ease;">
                    <span>🔍</span>
                    <span>View Details</span>
                </a>
            </div>
        </div>
        @empty
        <div class="card" style="text-align:center; color:#ffd8a9; font-size:1.2rem; padding:28px; border-radius:24px;">
            No services available.
        </div>
        @endforelse
    </div>
</section>

{{-- Pagination --}}
<section style="margin-top:40px; display:flex; justify-content:center;">
    {{ $services->links('pagination::bootstrap-5') }}
</section>

{{-- Decorative Floating Icons --}}
<div style="position:absolute; top:10%; left:5%; font-size:4rem; color: rgba(214,168,79,.08); animation: floatIcon 6s ease-in-out infinite;">✦</div>
<div style="position:absolute; bottom:12%; right:7%; font-size:5rem; color: rgba(214,168,79,.08); animation: floatIcon 5.8s ease-in-out infinite;">🕊️</div>
<div style="position:absolute; top:28%; right:12%; font-size:3rem; color: rgba(243,216,145,.07); animation: floatIcon 6.5s ease-in-out infinite;">🕯️</div>

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

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 22px;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 42px rgba(214,168,79,.28);
        transition: transform .3s ease, box-shadow .3s ease;
    }
</style>
@endpush

@endsection