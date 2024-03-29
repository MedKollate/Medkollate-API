<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;

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
// Route::post('register', [RegisteredUserController::class, 'store']);
require __DIR__.'/auth.php';
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/clinics', \App\Http\Controllers\API\ClinicController::class);
    Route::apiResource('/staff', \App\Http\Controllers\API\StaffController::class);

});

