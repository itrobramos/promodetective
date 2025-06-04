<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/categoria/{name}', [IndexController::class, 'categoryOffers'])->name('categoryOffers');
Route::post('/product/like/{id}', [IndexController::class, 'likeProduct'])->name('product.like');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');