<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CompanyManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QualityEngineer\DatasetController;
use App\Http\Controllers\CompanyAdmin\ManufacturingSetupController;
use App\Http\Controllers\CompanyAdmin\UserAssignmentController;
use App\Http\Controllers\QualityEngineer\PredictionController;
use App\Http\Controllers\QualityEngineer\DefectController;
use App\Http\Controllers\QualityEngineer\InspectionController;
use App\Http\Controllers\QualityEngineer\AlertController;




Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active', 'absolute'])->group(function () {

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
| Quality Engineer - Dataset Management
|--------------------------------------------------------------------------
*/

    Route::middleware('role:quality_engineer')->prefix('qe')->name('qe.')->group(function () {

        Route::get('/datasets', [DatasetController::class, 'index'])
            ->name('datasets.index');

        Route::get('/datasets/create', [DatasetController::class, 'create'])
            ->name('datasets.create');

        Route::post('/datasets', [DatasetController::class, 'store'])
            ->name('datasets.store');

        Route::get('/datasets/{id}', [DatasetController::class, 'show'])
            ->whereNumber('id')
            ->name('datasets.show');

        Route::post('/datasets/{id}/validate', [DatasetController::class, 'validate'])
            ->whereNumber('id')
            ->name('datasets.validate');

        // Prediction Management
        Route::get('/predictions', [PredictionController::class, 'index'])
            ->name('predictions.index');

        Route::post('/datasets/{datasetId}/predict', [PredictionController::class, 'store'])
            ->whereNumber('datasetId')
            ->name('predictions.store');

        Route::get('/predictions/{id}', [PredictionController::class, 'show'])
            ->whereNumber('id')
            ->name('predictions.show');

        // Defect Management
        Route::get('/defects', [DefectController::class, 'index'])
            ->name('defects.index');

        Route::get('/defects/create', [DefectController::class, 'create'])
            ->name('defects.create');

        Route::post('/defects', [DefectController::class, 'store'])
            ->name('defects.store');

        Route::get('/defects/{id}', [DefectController::class, 'show'])
            ->whereNumber('id')
            ->name('defects.show');

        Route::put('/defects/{id}', [DefectController::class, 'update'])
            ->whereNumber('id')
            ->name('defects.update');


        // Quality Alerts
        Route::get('/alerts', [AlertController::class, 'index'])
            ->name('alerts.index');
        // Inspection Management
        Route::get('/inspections', [InspectionController::class, 'index'])
            ->name('inspections.index');

        Route::get('/inspections/create', [InspectionController::class, 'create'])
            ->name('inspections.create');

        Route::post('/inspections', [InspectionController::class, 'store'])
            ->name('inspections.store');

        Route::get('/inspections/{id}', [InspectionController::class, 'show'])
            ->whereNumber('id')
            ->name('inspections.show');

        Route::put('/inspections/{id}', [InspectionController::class, 'update'])
            ->whereNumber('id')
            ->name('inspections.update');
    });

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
| Company Administrator - Manufacturing Setup
|--------------------------------------------------------------------------
*/

    Route::middleware('role:company_administrator')
        ->prefix('company-admin')
        ->name('company-admin.')
        ->group(function () {

            Route::get('/manufacturing', [ManufacturingSetupController::class, 'index'])
                ->name('manufacturing.index');

            Route::post('/factories', [ManufacturingSetupController::class, 'storeFactory'])
                ->name('factories.store');

            Route::post('/production-lines', [ManufacturingSetupController::class, 'storeProductionLine'])
                ->name('production-lines.store');

            Route::post('/machines', [ManufacturingSetupController::class, 'storeMachine'])
                ->name('machines.store');

            Route::get('/assignments', [UserAssignmentController::class, 'index'])
                ->name('assignments.index');

            Route::post('/assignments', [UserAssignmentController::class, 'store'])
                ->name('assignments.store');

            Route::patch('/assignments/{id}/end', [UserAssignmentController::class, 'end'])
                ->whereNumber('id')
                ->name('assignments.end');

            Route::patch('/machines/{id}/toggle-status', [ManufacturingSetupController::class, 'toggleMachineStatus'])
                ->whereNumber('id')
                ->name('machines.toggle-status');
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
