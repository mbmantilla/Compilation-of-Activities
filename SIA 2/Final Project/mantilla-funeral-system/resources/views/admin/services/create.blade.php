@extends('layouts.app', ['title' => 'Create Service'])

@section('content')
<div class="card">
    <h1>Add Funeral Service</h1>
    @include('admin.services.form', [
        'service' => null,
        'action' => route('admin.services.store'),
        'method' => 'POST'
    ])
</div>
@endsection
