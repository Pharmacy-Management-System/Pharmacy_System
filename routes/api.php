<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/sanctum/token',[AuthController::class, 'getToken'])->name('auth.getToken');

Route::group(["middleware"=>"auth:sanctum"],function (){
    Route::put('/client/{id}',[ClientController::class, 'update']);
    Route::get('/client/{id}',[ClientController::class, 'index']);
});