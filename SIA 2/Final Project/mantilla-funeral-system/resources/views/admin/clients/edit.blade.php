@extends('layouts.app', ['title' => 'Edit Client'])

@section('content')
<div class="card">
    <h1>Edit Client Record</h1>

    <form method="POST" action="{{ route('admin.clients.update', $client) }}">
        @csrf
        @method('PUT')

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $client->name) }}" required>

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $client->phone) }}">

        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', $client->address) }}">

        <br><br>
        <button class="btn" type="submit">Update Client</button>
    </form>
</div>
@endsection
