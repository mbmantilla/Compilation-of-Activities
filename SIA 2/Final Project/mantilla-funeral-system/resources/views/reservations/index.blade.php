@extends('layouts.app', ['title' => 'My Reservations'])

@section('content')
<h1>My Reservations</h1>

<div class="card">
    @include('partials.reservation-table', ['reservations' => $reservations, 'clientView' => true])
</div>

{{ $reservations->links() }}
@endsection
