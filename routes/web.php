<?php

use Illuminate\Support\Facades\Route;

Route::get('/', action: [App\Http\Controllers\ViewController::class, 'index'])->name('index');
Route::post('/download', action: [App\Http\Controllers\ViewController::class, 'download'])->name('download');
