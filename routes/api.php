<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;
use App\Http\Controllers\AuthController;

//Publica
Route::post('login', [AuthController::class, 'login']);

//Protegidas
Route::middleware('jwt.auth')->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('dogs', [DogController::class, 'index']);
    Route::get('dogs/{id}', [DogController::class, 'show']);
    Route::post('dogs', [DogController::class, 'store']);
    Route::put('dogs/{id}', [DogController::class, 'update']);
    Route::delete('dogs/{id}', [DogController::class, 'destroy']);
}); 