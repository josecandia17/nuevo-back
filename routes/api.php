<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas autecticacion 
Route::prefix('/v1/auth')->group(function () {

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register', [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/perfil', [AuthController::class, "funPerfil"]);
        Route::post('/logout', [AuthController::class, "funSalir"]);
    });
});
