<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\DoctorsController;

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

//Home Route
Route::get('/', function () {
    return view('index');
});

//Area Routes
Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');

//Pharmacy Routes
Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
Route::delete('/pharmacies/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('pharmacies.show');
Route::put('/pharmacies/{pharmacy}', [PharmacyController::class, 'update'])->name('pharmacies.update');
Route::get('/pharmacies/{pharmacy}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');



//Doctor Routes
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');