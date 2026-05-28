<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect admins to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $userId = $user->id;
        $today = Carbon::today();

        // Define last month range
        $firstDayLastMonth = $today->copy()->subMonth()->startOfMonth();
        $lastDayLastMonth = $today->copy()->subMonth()->endOfMonth();

        // Recent reservations (latest 5)
        $reservations = Reservation::with('service')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Counts
        $counts = [
            'total' => Reservation::where('user_id', $userId)->count(),
            'pending' => Reservation::where('user_id', $userId)->where('status', 'pending')->count(),
            'approved' => Reservation::where('user_id', $userId)->where('status', 'approved')->count(),
            'cancelled' => Reservation::where('user_id', $userId)->where('status', 'cancelled')->count(),

            // Additional Metrics
            'upcoming' => Reservation::where('user_id', $userId)
                ->where('status', 'approved')
                ->whereDate('preferred_schedule', '>', $today)
                ->count(),

            'approved_last_month' => Reservation::where('user_id', $userId)
                ->where('status', 'approved')
                ->whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])
                ->count(),

            'cancelled_last_month' => Reservation::where('user_id', $userId)
                ->where('status', 'cancelled')
                ->whereBetween('updated_at', [$firstDayLastMonth, $lastDayLastMonth])
                ->count(),

            'pending_last_month' => Reservation::where('user_id', $userId)
                ->where('status', 'pending')
                ->whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])
                ->count(),
        ];

        return view('dashboard', compact('reservations', 'counts'));
    }
}