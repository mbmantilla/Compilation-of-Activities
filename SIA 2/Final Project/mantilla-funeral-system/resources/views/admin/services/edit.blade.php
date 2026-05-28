@extends('layouts.app', ['title' => 'Edit Service'])

@section('content')
<div class="card">
    <h1>Edit Funeral Service</h1>
    @include('admin.services.form', [
        'service' => $service,
        'action' => route('admin.services.update', $service),
        'method' => 'PUT'
    ])
</div>
@endsection
