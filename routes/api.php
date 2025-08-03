<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\AnimeListApi;
use App\Http\Controllers\MyAnimeController;
use App\Http\Controllers\VideoUploadController;
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
    Route::prefix('animelist')->group(function () {
        Route::get('/anime', [AnimeListApi::class, 'AllAnime']);
        Route::get('/detail-anime', [AnimeListApi::class, 'getAnimeById']);
        Route::post('/save-anime', [AnimeListApi::class, 'saveAnime']);
        Route::post('/upload-video', [VideoUploadController::class, 'upload']);
    });
    Route::apiResource('anime', MyAnimeController::class)->except(['store']);
    Route::get('/video-proxy/{fileId}', [VideoUploadController::class, 'stream']);
});

