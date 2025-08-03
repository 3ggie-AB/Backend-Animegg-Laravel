<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'animes';
    protected $guarded = [];
    
    protected $casts = [
        'main_picture' => 'array',
        'alternative_titles' => 'array',
        'genres' => 'array',
        'start_season' => 'array',
        'broadcast' => 'array',
        'studios' => 'array',
        'pictures' => 'array',
        'related_anime' => 'array',
        'related_manga' => 'array',
        'recommendations' => 'array',
        'statistics' => 'array',
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
