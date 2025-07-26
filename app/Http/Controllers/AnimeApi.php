<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeApi extends Controller
{
    public function AllAnime($limit = 10, $offset = 0, $search = null){
        return AnimeController::allListAnime($limit, $offset, $search);
    }
}
