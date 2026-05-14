@extends('layouts.app')

@section('content')

<h2 class="hero-title">{{ $hero->name }}</h2>

<div class="card detail-card">

    <img src="{{ asset('images/' . ($hero->image ?? 'default.jpg')) }}" 
         class="hero-img-large">

    <div class="hero-info">
        <p><strong>Role:</strong> {{ $hero->role }}</p>
        <p><strong>Playstyle:</strong> {{ $hero->playstyle }}</p>
        <p><strong>Difficulty:</strong> {{ $hero->difficulty }}</p>
        <p><strong>Description:</strong> {{ $hero->description }}</p>
    </div>

    <a href="/heroes" class="btn">⬅ Back to List</a>

</div>

@endsection