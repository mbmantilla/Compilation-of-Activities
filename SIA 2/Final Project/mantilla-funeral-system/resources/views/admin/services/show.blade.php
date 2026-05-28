@extends('layouts.app', ['title' => 'Service Details'])

@section('content')
<div class="card">
    <h1>{{ $service->name }}</h1>
    <p><strong>Price:</strong> ₱{{ number_format($service->price, 2) }}</p>
    <p><strong>Availability:</strong> <span class="badge {{ $service->availability_status }}">{{ ucfirst($service->availability_status) }}</span></p>
    <p><strong>Total Reservations:</strong> {{ $service->reservations_count }}</p>

    <h3>Description</h3>
    <p>{{ $service->description }}</p>

    <h3>Inclusions</h3>
    <p style="white-space: pre-line;">{{ $service->inclusions }}</p>

    <a class="btn" href="{{ route('admin.services.edit', $service) }}">Edit Service</a>
</div>
@endsection
