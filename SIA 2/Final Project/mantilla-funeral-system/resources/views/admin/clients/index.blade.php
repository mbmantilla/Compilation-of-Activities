@extends('layouts.app', ['title' => 'Client Records'])

@section('content')
<h1>Client Records</h1>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Reservations</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone ?? 'N/A' }}</td>
                    <td>{{ $client->reservations_count }}</td>
                    <td><a class="btn" href="{{ route('admin.clients.show', $client) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No client records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $clients->links() }}
@endsection
