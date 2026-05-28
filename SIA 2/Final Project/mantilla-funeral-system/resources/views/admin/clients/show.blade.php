@extends('layouts.app', ['title' => 'Client Details'])

@section('content')
<div class="card">
    <h1>{{ $client->name }}</h1>
    <p><strong>Email:</strong> {{ $client->email }}</p>
    <p><strong>Phone:</strong> {{ $client->phone ?? 'N/A' }}</p>
    <p><strong>Address:</strong> {{ $client->address ?? 'N/A' }}</p>
    <a class="btn" href="{{ route('admin.clients.edit', $client) }}">Edit Client Record</a>
</div>

<div class="card">
    <h2>Reservations</h2>
    @include('partials.reservation-table', ['reservations' => $client->reservations, 'clientView' => false])
</div>
@endsection
