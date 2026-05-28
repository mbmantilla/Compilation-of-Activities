@extends('layouts.app', ['title' => 'Manage Services'])

@section('content')
<h1>Manage Funeral Service Listings</h1>

<p><a class="btn" href="{{ route('admin.services.create') }}">Add New Service</a></p>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>₱{{ number_format($service->price, 2) }}</td>
                    <td><span class="badge {{ $service->availability_status }}">{{ ucfirst($service->availability_status) }}</span></td>
                    <td class="actions">
                        <a class="btn" href="{{ route('admin.services.show', $service) }}">View</a>
                        <a class="btn" href="{{ route('admin.services.edit', $service) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No services found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $services->links() }}
@endsection
