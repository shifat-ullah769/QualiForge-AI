<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserManagementController::class, 'index'])
    ->middleware(['auth', 'role:system_administrator'])
    ->name('users.index');

Route::get('/users/create', [UserManagementController::class, 'create'])
    ->middleware(['auth', 'role:system_administrator'])
    ->name('users.create');

Route::post('/users', [UserManagementController::class, 'store'])
    ->middleware(['auth', 'role:system_administrator'])
    ->name('users.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
    ->name('profile.photo.delete');
});



require __DIR__.'/auth.php';
