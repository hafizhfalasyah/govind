<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('user.home');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // HOME ROUTES
    Route::get('/home', [AdminController::class, 'home'])->name('home');

    // USER ROUTES
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::post('/user/store', [AdminController::class, 'userStore'])->name('user.store');
    Route::put('/user/update/{id}', [AdminController::class, 'userUpdate'])->name('user.update');
    Route::delete('/user/delete/{id}', [AdminController::class, 'userDestroy'])->name('user.delete');

    // CATEGORY ROUTES
    Route::get('/category', [AdminController::class, 'category'])->name('category');
    Route::post('/category/store', [AdminController::class, 'categoryStore'])->name('category.store');
    Route::put('/category/update/{id}', [AdminController::class, 'categoryUpdate'])->name('category.update');
    Route::delete('/category/delete/{id}', [AdminController::class, 'categoryDestroy'])->name('category.delete');

    // PROGRAM ROUTES
    Route::get('/program', [AdminController::class, 'program'])->name('program');
    Route::post('/program/store', [AdminController::class, 'programStore'])->name('program.store');
    Route::put('/program/update/{id}', [AdminController::class, 'programUpdate'])->name('program.update');
    Route::delete('/program/delete/{id}', [AdminController::class, 'programDestroy'])->name('program.delete');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // HOME ROUTES
    Route::get('/home', [UserController::class, 'userHome'])->name('home');
});

require __DIR__.'/auth.php';
