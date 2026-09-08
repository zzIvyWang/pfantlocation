<?php

namespace App\Http\Controllers;

use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        // 1. 從資料庫撈出所有的地點（連同發布者資訊與留言）
        $locations = Location::with(['user', 'comments'])->latest()->get();

        // 2. 將 $locations 變數傳給 index 網頁模板
        return view('welcome', compact('locations'));
    }
}
