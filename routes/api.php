<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\AnimeListApi;
use App\Http\Controllers\MyAnimeController;
use App\Http\Controllers\UserController;
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
        Route::get('/anime', [AnimeListApi::class, 'AllAnime'])->middleware(['require.tag:admin,animelist,animelistCreate']);
        Route::get('/detail-anime', [AnimeListApi::class, 'getAnimeById'])->middleware(['require.tag:admin,animelist,animelistDetail']);
        Route::post('/save-anime', [AnimeListApi::class, 'saveAnime'])->middleware(['require.tag:admin,animelist,animelistSave']);
    });
    Route::post('/upload-video', [VideoUploadController::class, 'upload'])->middleware(['require.tag:admin,myanimeupload']);

    Route::prefix('anime')->group(function () {
        Route::get('/', [MyAnimeController::class, 'index']);
        Route::get('/{anime}', [MyAnimeController::class, 'show']);
        Route::get('/video/{anime}', [MyAnimeController::class, 'video']);
        Route::put('/{anime}', [MyAnimeController::class, 'update'])
        ->middleware('require.tag:myanimeEdit,admin');
        Route::delete('/{anime}', [MyAnimeController::class, 'destroy'])
        ->middleware('require.tag:myanimeDelete,admin');
    });
    Route::get('/video-upload/{video}', [VideoUploadController::class, 'show']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware(['require.tag:admin,users,listUser']);
        Route::post('/', [UserController::class, 'store'])->middleware(['require.tag:admin,users,addUser']);
        Route::get('/{id}', [UserController::class, 'show'])->middleware(['require.tag:admin,users,viewUser']);
        Route::put('/{id}', [UserController::class, 'update'])->middleware(['require.tag:admin,users,editUser']);
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware(['require.tag:admin,users,deleteUser']);
    });
});

