<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function welcome(): View
    {
        return view('welcome');
    }

    public function index(): View
    {
        $locations = Location::with(['comments.user', 'user'])->latest()->get();

        return view('locations.index', compact('locations'));
    }

    public function create(): View
    {
        return view('locations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $request->user()->locations()->create($validated);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    public function show(Location $location): View
    {
        $location->load(['comments.user', 'user']);

        return view('locations.show', compact('location'));
    }

    public function edit(Request $request, Location $location): View
    {
        abort_unless($request->user()->role === 'admin', 403);

        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location): RedirectResponse
    {
        abort_unless($request->user()->role === 'admin', 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $location->update($validated);

        return redirect()->route('locations.show', $location)->with('success', 'Location updated successfully.');
    }

    public function destroy(Request $request, Location $location): RedirectResponse
    {
        abort_unless($request->user()->role === 'admin', 403);

        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
