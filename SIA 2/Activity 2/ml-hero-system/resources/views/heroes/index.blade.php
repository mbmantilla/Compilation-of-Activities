@extends('layouts.app')

@section('content')

<h2 class="hero-title">⚔️ Hero List ⚔️</h2>

<!-- SEARCH BAR -->
<div class="search-box">
    <form method="GET" action="/heroes">
        <input type="text" name="search" placeholder="Search hero...">
        <button type="submit">Search</button>
    </form>
</div>

<div class="grid">
    @foreach($heroes as $hero)
        <div class="card">

            <img src="{{ asset('images/' . ($hero->image ?? 'default.jpg')) }}" class="hero-img">

            <h3>{{ $hero->name }}</h3>

            <p>
                <strong>Role:</strong> 
                <span class="badge">{{ $hero->role }}</span>
            </p>

            <p><strong>Playstyle:</strong> {{ $hero->playstyle }}</p>

            <a href="/heroes/{{ $hero->id }}" class="btn">View Details</a>

        </div>
    @endforeach
</div>

<!-- PAGINATION -->
<div style="margin-top: 20px; text-align:center;">
    {{ $heroes->links() }}
</div>

@endsection