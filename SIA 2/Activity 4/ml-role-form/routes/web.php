<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ml-form', [FormController::class, 'create']);
Route::post('/ml-form', [FormController::class, 'store']);