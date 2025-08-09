<?php

use App\Http\Controllers\VideoUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: [App\Http\Controllers\ViewController::class, 'index'])->name('index');
Route::post('/download', action: [App\Http\Controllers\ViewController::class, 'download'])->name('download');

Route::get('/video-proxy/{fileId}', [VideoUploadController::class, 'stream']);