@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="card">
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>
            <input type="checkbox" name="remember" value="1" style="width:auto;">
            Remember me
        </label>

        <br>
        <button class="btn" type="submit">Login</button>
    </form>
</div>
@endsection
