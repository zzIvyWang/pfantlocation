<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LocationController::class, 'welcome'])->name('welcome');
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->middleware('auth')->name('locations.create');
Route::post('/locations', [LocationController::class, 'store'])->middleware('auth')->name('locations.store');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->middleware('auth')->name('locations.edit');
Route::put('/locations/{location}', [LocationController::class, 'update'])->middleware('auth')->name('locations.update');
Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->middleware('auth')->name('locations.destroy');
Route::post('/locations/{location}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
