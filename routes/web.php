<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\DependentController;
use App\Http\Controllers\Admin\HouseholdController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\BusinessManagerController;
use App\Http\Controllers\Admin\AccommodationTenantController;
use App\Http\Controllers\Admin\BusinessEstablishmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Admin/Index');
    })->name('admin');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::get('/residents', [ResidentController::class, 'index'])->name('admin.residents.index');
    Route::post('/residents', [ResidentController::class, 'store'])->name('admin.residents.store');
    Route::put('/residents/{resident}', [ResidentController::class, 'update'])->name('admin.residents.update');
    Route::get('/residents/{resident}', [ResidentController::class, 'show'])->name('admin.residents.show');
    Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])->name('admin.residents.destroy');

    Route::get('/accommodations', [AccommodationController::class, 'index'])->name('admin.accommodations.index');
    Route::post('/accommodations', [AccommodationController::class, 'store'])->name('admin.accommodations.store');
    Route::put('/accommodations/{accommodation}', [AccommodationController::class, 'update'])->name('admin.accommodations.update');
    Route::delete('/accommodations/{accommodation}', [AccommodationController::class, 'destroy'])->name('admin.accommodations.destroy');

    Route::get('/business-establishments', [BusinessEstablishmentController::class, 'index'])->name('admin.business-establishments.index');
    Route::post('/business-establishments', [BusinessEstablishmentController::class, 'store'])->name('admin.business-establishments.store');
    Route::put('/business-establishments/{establishment}', [BusinessEstablishmentController::class, 'update'])->name('admin.business-establishments.update');
    Route::delete('/business-establishments/{establishment}', [BusinessEstablishmentController::class, 'destroy'])->name('admin.business-establishments.destroy');

    Route::get('/households', [HouseholdController::class, 'index'])->name('admin.households.index');
    Route::post('/households', [HouseholdController::class, 'store'])->name('admin.households.store');
    Route::put('/households/{household}', [HouseholdController::class, 'update'])->name('admin.households.update');
    Route::delete('/households/{household}', [HouseholdController::class, 'destroy'])->name('admin.households.destroy');
    Route::get('/households/{household}/dependents', [HouseholdController::class, 'getHouseholdDependents'])->name('admin.households.dependents');

    Route::get('/dependents', [DependentController::class, 'index'])->name('admin.dependents.index');
    Route::post('/dependents', [DependentController::class, 'store'])->name('admin.dependents.store');
    Route::put('/dependents/{dependent}', [DependentController::class, 'update'])->name('admin.dependents.update');
    Route::get('/dependents/{dependent}', [DependentController::class, 'show'])->name('admin.dependents.show');
    Route::delete('/dependents/{dependent}', [DependentController::class, 'destroy'])->name('admin.dependents.destroy');

    Route::get('/accommodation-tenants', [AccommodationTenantController::class, 'index'])->name('admin.accommodation-tenants.index');
    Route::post('/accommodation-tenants', [AccommodationTenantController::class, 'store'])->name('admin.accommodation-tenants.store');
    Route::put('/accommodation-tenants/{tenant}', [AccommodationTenantController::class, 'update'])->name('admin.accommodation-tenants.update');
    Route::delete('/accommodation-tenants/{tenant}', [AccommodationTenantController::class, 'destroy'])->name('admin.accommodation-tenants.destroy');

    Route::get('/business-managers', [BusinessManagerController::class, 'index'])->name('admin.business-managers.index');
    Route::post('/business-managers', [BusinessManagerController::class, 'store'])->name('admin.business-managers.store');
    Route::put('/business-managers/{manager}', [BusinessManagerController::class, 'update'])->name('admin.business-managers.update');
    Route::delete('/business-managers/{manager}', [BusinessManagerController::class, 'destroy'])->name('admin.business-managers.destroy');
});