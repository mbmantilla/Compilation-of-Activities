<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuneralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = FuneralService::latest()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);

        $validated['created_by'] = Auth::id();

        FuneralService::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Funeral service created successfully.');
    }

    public function show(FuneralService $service)
    {
        $service->loadCount('reservations');

        return view('admin.services.show', compact('service'));
    }

    public function edit(FuneralService $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, FuneralService $service)
    {
        $validated = $this->validateService($request);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Funeral service updated successfully.');
    }

    public function destroy(FuneralService $service)
    {
        if ($service->reservations()->exists()) {
            return back()->with('error', 'This service cannot be deleted because it already has reservations.');
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Funeral service deleted successfully.');
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'inclusions' => ['nullable', 'string'],
            'availability_status' => ['required', Rule::in(['available', 'unavailable'])],
            'image' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
