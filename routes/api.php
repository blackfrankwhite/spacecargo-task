<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParcelController;

Route::middleware(['log.http'])->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('parcels')->group(function () {
            Route::post('/', [ParcelController::class, 'store']);
            Route::get('/', [ParcelController::class, 'index']);
            Route::put('/{parcel}', [ParcelController::class, 'update']);
        });
    });
});
