<?php

use App\Models\Location;

Route::get('/', function () {
    // 撈出資料並傳給 resources/views/welcome.blade.php
    $locations = Location::with('comments.user')->get();
    return view('welcome', compact('locations'));
});
