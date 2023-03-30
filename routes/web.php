<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
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

//Area Routes

Route::get('/areas', [AreaController::class, 'index'])->name('index');
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');
Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');

//Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');

//Route::get('/areas/list', [AreaController::class, 'getAreas'])->name('areas.list');
//Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');

/* Route::get('/areas/create', [PostController::class, 'create'])->name('areas.create');
Route::get('/areas/{id}/edit', [PostController::class, 'edit'])->name('areas.edit');
Route::post('/areas', [PostController::class, 'store'])->name('areas.store');
Route::post('/areas/{id}', [PostController::class, 'update'])->name('areas.update');
Route::delete('/areas/{id}', [PostController::class, 'destroy'])->name('areas.destroy'); */


Route::get('/', function () {
    return view('index');
});
Route::get('/doctors/{id}', [DoctorsController::class, 'show'])->name('doctors.show');

