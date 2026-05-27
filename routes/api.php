<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\AppointmentController;

Route::post('/register',
    [AuthController::class,'register']);

Route::post('/login',
    [AuthController::class,'login']);

Route::middleware('auth:sanctum', 'throttle:60,1')
->group(function () {

    Route::post('/logout',
        [AuthController::class,'logout']);

    Route::apiResource(
        'doctors',
        DoctorController::class
    );

    Route::apiResource(
        'appointments',
        AppointmentController::class
    );
});

Route::middleware('auth:sanctum')
->get('/profile', function () {

    return auth()->user();

});

