<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VenueController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Venues
Route::get('/venues/create/{category}', [VenueController::class, 'create'])->name('venues.create')->middleware('auth');
Route::post('/venues', [VenueController::class, 'store'])->name('venues.store')->middleware('auth');
Route::get('venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

// Comments
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

// Auth
require __DIR__.'/auth.php';

// Language
Route::get('/lang/{key}', function ($key) {
    session()->put('locale', $key);
    return redirect()->back();
})->name('lang');

Route::get('/lang-{lang}.js', [App\Http\Controllers\LanguageController::class, 'load']);
