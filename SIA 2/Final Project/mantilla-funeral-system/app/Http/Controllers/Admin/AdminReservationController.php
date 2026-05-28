<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $reservations = Reservation::with(['client', 'service'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.reservations.index', compact('reservations', 'status'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['client', 'service', 'approver']);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function approve(Request $request, Reservation $reservation)
    {
        $request->validate([
            'admin_remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($reservation->status === 'cancelled') {
            return back()->with('error', 'Cancelled reservations cannot be approved.');
        }

        $reservation->update([
            'status' => 'approved',
            'admin_remarks' => $request->admin_remarks,
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Reservation approved successfully.');
    }

    public function reject(Request $request, Reservation $reservation)
    {
        $request->validate([
            'admin_remarks' => ['required', 'string', 'max:1000'],
        ]);

        if ($reservation->status === 'cancelled') {
            return back()->with('error', 'Cancelled reservations cannot be rejected.');
        }

        $reservation->update([
            'status' => 'rejected',
            'admin_remarks' => $request->admin_remarks,
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Reservation rejected successfully.');
    }
}
