<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CompanyManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('verified')
    ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:system_administrator,company_administrator')->group(function () {

        Route::get('/users', [UserManagementController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserManagementController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserManagementController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserManagementController::class, 'update'])
            ->name('users.update');

        Route::patch('/users/{user}/toggle-status', [UserManagementController::class, 'toggleStatus'])
            ->name('users.toggle-status');

        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
            ->name('users.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Company Management - System Admin + Company Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:system_administrator,company_administrator')->group(function () {

        Route::get('/companies', [CompanyManagementController::class, 'index'])
            ->name('companies.index');

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | /companies/create must come BEFORE /companies/{company}
        |--------------------------------------------------------------------------
        */

        Route::get('/companies/create', [CompanyManagementController::class, 'create'])
            ->middleware('role:system_administrator')
            ->name('companies.create');

        Route::post('/companies', [CompanyManagementController::class, 'store'])
            ->middleware('role:system_administrator')
            ->name('companies.store');

        Route::get('/companies/{company}', [CompanyManagementController::class, 'show'])
            ->name('companies.show');

        Route::get('/companies/{company}/edit', [CompanyManagementController::class, 'edit'])
            ->name('companies.edit');

        Route::put('/companies/{company}', [CompanyManagementController::class, 'update'])
            ->name('companies.update');

        Route::patch('/companies/{company}/toggle-status', [CompanyManagementController::class, 'toggleStatus'])
            ->name('companies.toggle-status');
    });


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.photo.delete');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
