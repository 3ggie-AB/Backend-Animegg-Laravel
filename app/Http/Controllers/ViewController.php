<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViewController extends Controller
{
    public function index()
    {
        $anime = AnimeController::topAnimeFavorite();
        return view('index', compact('anime'));
    }
    public function download()
    {
        return response()->download(public_path('apk/Animegg.apk'));
    }
}
