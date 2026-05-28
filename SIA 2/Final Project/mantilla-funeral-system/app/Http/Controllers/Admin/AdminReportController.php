<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuneralService;
use App\Models\Reservation;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminReportController extends Controller
{
    public function index()
    {
        $summary = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_services' => FuneralService::count(),
            'total_reservations' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'approved' => Reservation::where('status', 'approved')->count(),
            'rejected' => Reservation::where('status', 'rejected')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'estimated_revenue' => Reservation::where('status', 'approved')
                ->join('funeral_services', 'reservations.funeral_service_id', '=', 'funeral_services.id')
                ->sum('funeral_services.price'),
        ];

        $reservationsByService = FuneralService::withCount('reservations')
            ->orderByDesc('reservations_count')
            ->get();

        return view('admin.reports.index', compact('summary', 'reservationsByService'));
    }

    public function downloadReservationsCsv(): StreamedResponse
    {
        $fileName = 'mantilla_reservations_report_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Reservation Code',
                'Client',
                'Service',
                'Preferred Schedule',
                'Status',
                'Created At',
            ]);

            Reservation::with(['client', 'service'])
                ->latest()
                ->chunk(100, function ($reservations) use ($handle) {
                    foreach ($reservations as $reservation) {
                        fputcsv($handle, [
                            $reservation->reservation_code,
                            $reservation->client?->name,
                            $reservation->service?->name,
                            optional($reservation->preferred_schedule)->format('Y-m-d'),
                            $reservation->status,
                            $reservation->created_at->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
