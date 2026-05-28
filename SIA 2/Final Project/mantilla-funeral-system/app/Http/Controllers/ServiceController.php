<?php

namespace App\Http\Controllers;

use App\Models\FuneralService;

class ServiceController extends Controller
{
    public function home()
    {
        $services = FuneralService::where('availability_status', 'available')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('services'));
    }

    public function index()
    {
        $services = FuneralService::query()
            ->where('availability_status', 'available')
            ->latest()
            ->paginate(9);

        return view('services.index', compact('services'));
    }

    public function show(FuneralService $service)
    {
        return view('services.show', compact('service'));
    }
}
