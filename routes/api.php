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
    Route::get('/video-proxy/{fileId}', [VideoUploadController::class, 'stream']);
    Route::prefix('animelist')->group(function () {
        Route::get('/anime', [AnimeListApi::class, 'AllAnime'])->middleware(['require.tag:admin,animelist,animelistCreate']);
        Route::get('/detail-anime', [AnimeListApi::class, 'getAnimeById'])->middleware(['require.tag:admin,animelist,animelistDetail']);
        Route::post('/save-anime', [AnimeListApi::class, 'saveAnime'])->middleware(['require.tag:admin,animelist,animelistSave']);
    });
    Route::post('/upload-video', [VideoUploadController::class, 'upload'])->middleware(['require.tag:admin,myanimeupload']);

    Route::get('/anime', [MyAnimeController::class, 'index']);
    Route::get('/anime/{anime}', [MyAnimeController::class, 'show']);
    Route::put('/anime/{anime}', [MyAnimeController::class, 'update'])
        ->middleware('require.tag:myanimeEdit,admin');
    Route::delete('/anime/{anime}', [MyAnimeController::class, 'destroy'])
        ->middleware('require.tag:myanimeDelete,admin');
});

