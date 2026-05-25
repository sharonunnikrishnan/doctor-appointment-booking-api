<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')
    ->group(function(){

    Route::post('/register',
    [AuthController::class,'register']);

    Route::post('/login',
    [AuthController::class,'login']);

});


