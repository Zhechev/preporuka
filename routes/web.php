<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VenueController;

Route::get('/', [HomeController::class, 'index']);

// Categories
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Venues
Route::get('/venues/create', [VenueController::class, 'create'])->name('venues.create');
Route::post('/venues', [VenueController::class, 'store'])->name('venues.store');
Route::get('venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

require __DIR__.'/auth.php';
