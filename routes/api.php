<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/sanctum/token',[AuthController::class, 'getToken'])->name('auth.getToken');

Route::get('/verify-email/{id}/{hash}',[AuthController::class, 'verify'])->name('verification.verify');

Route::post('/register', [ClientController::class, 'store'])->name('clients.store');
