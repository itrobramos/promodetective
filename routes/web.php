<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MonitoredProductController;
use App\Http\Controllers\UserProfilePhotoController;

// Redireccionar /login a la página principal
Route::redirect('/login', '/', 301);

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/categoria/{name}', [IndexController::class, 'categoryOffers'])->name('categoryOffers');
Route::post('/product/like/{id}', [IndexController::class, 'likeProduct'])->name('product.like')->middleware('auth');
Route::delete('/product/like/{id}', [IndexController::class, 'unlikeProduct'])->name('product.unlike')->middleware('auth');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::post('/products/{id}/report', [IndexController::class, 'reportProduct'])->name('report.product');

// Rutas de perfil de usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('/user/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/products/monitor', [MonitoredProductController::class, 'store'])->name('products.monitor');
    
    // User Profile Photo Routes
    Route::post('/user/profile-photo', [UserProfilePhotoController::class, 'store'])->name('user-profile-photo.store');
    Route::delete('/user/profile-photo', [UserProfilePhotoController::class, 'destroy'])->name('user-profile-photo.destroy');
});

// Google OAuth Routes
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);