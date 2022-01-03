<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index']);

// Categories
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');

require __DIR__.'/auth.php';
