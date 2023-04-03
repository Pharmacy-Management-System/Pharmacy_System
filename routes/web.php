<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevenueController;
use  Illuminate\Support\Facades\Auth;

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
// Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
// Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
// Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
// Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
// Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
// Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');

// //Clients Routes
// Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
// Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
// Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
// Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
// Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
// Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

// //address routes
// Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
// Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
// Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('addresses.show');
// Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
// Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');

// //Pharmacy Routes
// Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
// Route::delete('/pharmacies/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
// Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('pharmacies.show');
// Route::put('/pharmacies/{pharmacy}', [PharmacyController::class, 'update'])->name('pharmacies.update');
// Route::get('/pharmacies/{pharmacy}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
// Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
// Route::get('/pharmacies/restore/{pharmacy}', [PharmacyController::class, 'restore'])->name('pharmacies.restore');

// //Doctor Routes
// Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
// Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
// Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
// Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
// Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
// Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');

// //Medicine Routes
// Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
// Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
// Route::get('/medicines/{id}', [MedicineController::class, 'show'])->name('medicines.show');
// Route::get('/medicines/{id}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
// Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
// Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');

// //Revenue Routes
// Route::get('/revenue', [RevenueController::class, 'index'])->name('revenues.index');

//Auth Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');








// //orders routes
// Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
// Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');



Auth::routes();
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
    Route::put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');

    //Clients Routes
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    //address routes
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('addresses.show');
    Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');

    //Pharmacy Routes
    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::delete('/pharmacies/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
    Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('pharmacies.show');
    Route::put('/pharmacies/{pharmacy}', [PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::get('/pharmacies/{pharmacy}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::get('/pharmacies/restore/{pharmacy}', [PharmacyController::class, 'restore'])->name('pharmacies.restore');

    //Doctor Routes
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');

    //Medicine Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{orders}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    //Revenue Routes
    Route::get('/revenue', [RevenueController::class, 'index'])->name('revenues.index');

});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{orders}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
});

