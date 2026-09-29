<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. 公開頁面 (不需要登入也能看的列表與詳細資訊)
// 這會呼叫 LocationController 的 index() 方法
Route::get('/', [LocationController::class, 'index'])->name('locations.index');

// 這會呼叫 LocationController 的 show() 方法
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');


// 2. 需登入才能存取的頁面 (使用 'auth' 中間件保護)
Route::middleware(['auth'])->group(function () {

    // 顯示新增地點表單 (對應 create 方法)
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');

    // 儲存新增地點 (對應 store 方法)
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');

    // 顯示編輯地點表單 (對應 edit 方法)
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');

    // 儲存更新地點 (對應 update 方法)
    Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');

    // 刪除地點 (對應 destroy 方法)
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

});

// 3. Breeze 生成的驗證路由（包含登入、註冊、登出的背後邏輯）
require __DIR__.'/auth.php';
