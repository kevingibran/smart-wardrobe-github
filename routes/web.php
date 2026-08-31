<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\WardrobeController;
use App\Http\Controllers\User\RecommendationController;
use App\Http\Controllers\User\CatalogController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route for generic authenticated users
Route::middleware(['auth'])->group(function () {
    // Both user and admin can see their own home page, but we'll redirect them appropriately
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User routes
    Route::post('wardrobes/add-from-product', [WardrobeController::class, 'storeFromProduct'])->name('wardrobes.storeFromProduct');
    Route::resource('wardrobes', WardrobeController::class);
    Route::get('recommendation', [RecommendationController::class, 'index'])->name('recommendation.index');
    Route::post('recommendation/match', [RecommendationController::class, 'match'])->name('recommendation.match');
    
    Route::get('catalog', [CatalogController::class, 'index'])->name('catalog.index');
});

// Admin routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
});
