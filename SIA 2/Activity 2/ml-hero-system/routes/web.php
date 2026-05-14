<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;

Route::get('/', [HeroController::class, 'index']);
Route::get('/heroes', [HeroController::class, 'index']);
Route::get('/heroes/{id}', [HeroController::class, 'show']);