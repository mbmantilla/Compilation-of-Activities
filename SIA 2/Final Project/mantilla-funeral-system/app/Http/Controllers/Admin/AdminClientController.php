<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')
            ->withCount('reservations')
            ->latest()
            ->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        abort_unless($client->role === 'client', 404);

        $client->load(['reservations.service']);

        return view('admin.clients.show', compact('client'));
    }

    public function edit(User $client)
    {
        abort_unless($client->role === 'client', 404);

        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        abort_unless($client->role === 'client', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.show', $client)
            ->with('success', 'Client record updated successfully.');
    }
}
