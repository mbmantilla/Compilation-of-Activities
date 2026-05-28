<?php

namespace App\Http\Controllers;

use App\Models\FuneralService;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a paginated list of client reservations
     */
    public function index()
    {
        $reservations = Reservation::with('service')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the reservation creation form for a selected service
     */
    public function create(FuneralService $service)
    {
        if (! $service->isAvailable()) {
            return redirect()->route('services.show', $service)
                ->with('error', 'This service is currently unavailable.');
        }

        return view('reservations.create', compact('service'));
    }

    /**
     * Store a new reservation
     */
    public function store(Request $request, FuneralService $service)
    {
        if (! $service->isAvailable()) {
            return redirect()->route('services.show', $service)
                ->with('error', 'This service is currently unavailable.');
        }

        $validated = $request->validate([
            'deceased_name' => ['required', 'string', 'max:150'],
            'deceased_age' => ['nullable', 'integer', 'min:0', 'max:130'],
            'date_of_death' => ['nullable', 'date'],
            'preferred_schedule' => ['required', 'date', 'after_or_equal:today'],
            'contact_person' => ['required', 'string', 'max:150'],
            'contact_number' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $reservation = Reservation::create([
            'reservation_code' => 'MFRS-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'funeral_service_id' => $service->id,
            'deceased_name' => $validated['deceased_name'],
            'deceased_age' => $validated['deceased_age'] ?? null,
            'date_of_death' => $validated['date_of_death'] ?? null,
            'preferred_schedule' => $validated['preferred_schedule'],
            'contact_person' => $validated['contact_person'],
            'contact_number' => $validated['contact_number'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation submitted successfully. Please wait for admin approval.');
    }

    /**
     * Show a specific reservation
     */
    public function show(Reservation $reservation)
    {
        // Ensure only the reservation owner can view
        abort_unless($reservation->user_id === Auth::id(), 403);

        $reservation->load('service');

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Cancel a reservation (client action)
     */
    public function cancel(Reservation $reservation)
    {
        // Only the owner can cancel
        abort_unless($reservation->user_id === Auth::id(), 403);

        // Only pending reservations can be cancelled
        if (! $reservation->canBeCancelled()) {
            return back()->with('error', 'This reservation can no longer be cancelled.');
        }

        $reservation->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Reservation cancelled successfully.');
    }
}