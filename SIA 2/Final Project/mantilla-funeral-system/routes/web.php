<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminReportController;

Route::get('/', [ServiceController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/services/{service}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/services/{service}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/services', AdminServiceController::class);

        Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}', [AdminReservationController::class, 'show'])->name('reservations.show');
        Route::patch('/reservations/{reservation}/approve', [AdminReservationController::class, 'approve'])->name('reservations.approve');
        Route::patch('/reservations/{reservation}/reject', [AdminReservationController::class, 'reject'])->name('reservations.reject');

        Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
        Route::get('/clients/{client}', [AdminClientController::class, 'show'])->name('clients.show');
        Route::get('/clients/{client}/edit', [AdminClientController::class, 'edit'])->name('clients.edit');
        Route::put('/clients/{client}', [AdminClientController::class, 'update'])->name('clients.update');

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/reservations.csv', [AdminReportController::class, 'downloadReservationsCsv'])->name('reports.reservations.csv');
    });
