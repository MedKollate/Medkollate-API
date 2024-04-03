<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\ClinicUsersController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
// Route::post('/register', [UserController::class, 'store'])->name('api.register');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('clinics', ClinicController::class);

        // Clinic Users
        Route::get('/clinics/{clinic}/users', [
            ClinicUsersController::class,
            'index',
        ])->name('clinics.users.index');
        Route::post('/clinics/{clinic}/users', [
            ClinicUsersController::class,
            'store',
        ])->name('clinics.users.store');

        Route::apiResource('users', UserController::class);

        /////////////////////////////////
        Route::get('patients', [UserController::class, 'patientsCount']);
        Route::get('staff', [UserController::class, 'staffCount']);
        Route::get('department', [UserController::class, ' departmentsCount']);
    });
