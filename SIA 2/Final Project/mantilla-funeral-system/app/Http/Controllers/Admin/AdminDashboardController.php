<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuneralService;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Key metrics
        $counts = [
            'services' => FuneralService::count(),
            'available_services' => FuneralService::where('availability_status', 'available')->count(),
            'clients' => User::where('role', 'client')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'approved_reservations' => Reservation::where('status', 'approved')->count(),
            'rejected_reservations' => Reservation::where('status', 'rejected')->count(),
            'cancelled_reservations' => Reservation::where('status', 'cancelled')->count(),
        ];

        // Recent reservations
        $recentReservations = Reservation::with(['client', 'service'])
            ->latest()
            ->take(10)
            ->get();

        // Analytics: Reservations by Status
        $analytics = [];
        $analytics['pending'] = $counts['pending_reservations'];
        $analytics['approved'] = $counts['approved_reservations'];
        $analytics['cancelled'] = $counts['cancelled_reservations'];

        // Analytics: Monthly reservations for last 12 months
        $analytics['months'] = [];
        $analytics['monthly_counts'] = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $analytics['months'][] = $month->format('M Y');
            $analytics['monthly_counts'][] = Reservation::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return view('admin.dashboard', compact('counts', 'recentReservations', 'analytics'));
    }
}