<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Service</th>
            @if(empty($clientView))
                <th>Client</th>
            @endif
            <th>Schedule</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reservations as $reservation)
            <tr>
                <td>{{ $reservation->reservation_code }}</td>
                <td>{{ $reservation->service?->name }}</td>
                @if(empty($clientView))
                    <td>{{ $reservation->client?->name }}</td>
                @endif
                <td>{{ optional($reservation->preferred_schedule)->format('M d, Y') }}</td>
                <td><span class="badge {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span></td>
                <td>
                    @if(!empty($clientView))
                        <a class="btn" href="{{ route('reservations.show', $reservation) }}">View</a>
                    @else
                        <a class="btn" href="{{ route('admin.reservations.show', $reservation) }}">View</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No reservations found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
