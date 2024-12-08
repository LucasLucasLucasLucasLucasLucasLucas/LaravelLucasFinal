<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', App\Http\Controllers\CategoriesController::class);
Route::resource('items', App\Http\Controllers\ItemsController::class);

Route::get('/items/delete/{id}', [App\Http\Controllers\ItemsController::class, 'itemsDelete']) ->name('items.itemsDelete');
