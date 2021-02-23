<?php

use App\Http\Controllers\Admin\CarrierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\CustomerTrackingController;
use Illuminate\Support\Facades\Route;

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

//Admin Routes
Route::middleware(['auth'])->prefix('berimtoo')->namespace('App')->group(function () {

    //Dashboard Route
    Route::get('dashboard', [DashboardController::class, "index"])->name('dashboard');

    //Tracking Routes
    Route::get('tracking', [TrackingController::class, 'index'])->name('tracking');
    Route::get('tracking/create', [TrackingController::class, 'create'])->name('tracking-create');
    Route::get('tracking/edit/{tracking}', [TrackingController::class, 'edit'])->name('tracking-edit');
    Route::post('tracking/update/{tracking}', [TrackingController::class, 'update'])->name('tracking-update');
    Route::post('tracking/uploadPostCodes', [TrackingController::class, 'storePostCodes'])->name('tracking-postcodes');
    Route::post('tracking/uploadMotorCodes', [TrackingController::class, 'storeMotorCodes'])->name('tracking-motorcodes');
    Route::post('tracking/storeTipax', [TrackingController::class, 'storeTipax'])->name('tracking-tipax');

    //Carriers Routes
    Route::get('carrier/create', [CarrierController::class, 'create'])->name('carrier-create');
    Route::post('carrier/store', [CarrierController::class, 'store'])->name('carrier-store');
    Route::get('carrier/edit/{carrier}', [CarrierController::class, 'edit'])->name('carrier-edit');
    Route::post('carrier/update/{carrier}', [CarrierController::class, 'update'])->name('carrier-update');
    Route::post('carrier/delete/{carrier}', [CarrierController::class, 'delete'])->name('carrier-delete');

});

//Front Routes
Route::get('/', [CustomerTrackingController::class, 'index'])->name('track');
Route::post('/', [CustomerTrackingController::class, 'find'])->name('customer.find-code');

//Authentication Routes
require __DIR__ . '/auth.php';
