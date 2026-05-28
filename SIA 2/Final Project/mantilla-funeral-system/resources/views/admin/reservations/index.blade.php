@extends('layouts.app', ['title' => 'Reservation Requests'])

@section('content')
<h1>Reservation Requests</h1>

<div class="card">
    <form method="GET" action="{{ route('admin.reservations.index') }}">
        <label>Filter by Status</label>
        <select name="status">
            <option value="">All</option>
            @foreach(['pending', 'approved', 'rejected', 'cancelled'] as $item)
                <option value="{{ $item }}" @selected($status === $item)>{{ ucfirst($item) }}</option>
            @endforeach
        </select>
        <br><br>
        <button class="btn" type="submit">Filter</button>
    </form>
</div>

<div class="card">
    @include('partials.reservation-table', ['reservations' => $reservations, 'clientView' => false])
</div>

{{ $reservations->links() }}
@endsection
