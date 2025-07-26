<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\AnimeApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/register', [AuthenticateController::class, 'register']);
Route::post('/login', [AuthenticateController::class, 'login']);
Route::get('/invalid', [AuthenticateController::class, 'invalid'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthenticateController::class, 'me']);
    Route::post('/logout', [AuthenticateController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
Route::get('/anime', [AnimeApi::class, 'AllAnime']);

