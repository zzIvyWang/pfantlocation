<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // 1. 列表頁 (Read All)
    public function index()
    {
        $locations = Location::with('comments.user')->latest()->get();
        return view('locations.index', compact('locations'));
    }

    // 2. 顯示新增表單 (Create Form)
    public function create()
    {
        return view('locations.create');
    }

    // 3. 處理表單新增資料 (Store)
    public function store(Request $request)
    {
        // 表單驗證 (Form Validation)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // 自動寫入當前登入使用者的 ID
        $request->user()->locations()->create($validated);

        return redirect()->route('locations.index')->with('success', 'Pfand Location created successfully!');
    }

    // 4. 顯示單一地點詳細資料 (Read One)
    public function show(Location $location)
    {
        $location->load('comments.user');
        return view('locations.show', compact('location'));
    }

    // 5. 顯示編輯表單 (Edit Form)
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // 6. 處理更新資料 (Update)
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully!');
    }

    // 7. 刪除地點 (Delete)
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');
    }
}
