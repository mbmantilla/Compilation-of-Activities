<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/users', function () {
    return response()->json(User::all());
});