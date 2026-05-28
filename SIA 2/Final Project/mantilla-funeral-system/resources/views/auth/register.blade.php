@extends('layouts.app', ['title' => 'Register'])

@section('content')
<div class="card">
    <h1>Client Registration</h1>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Phone Number</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>Address</label>
        <input type="text" name="address" value="{{ old('address') }}">

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <br><br>
        <button class="btn" type="submit">Register</button>
    </form>
</div>
@endsection
