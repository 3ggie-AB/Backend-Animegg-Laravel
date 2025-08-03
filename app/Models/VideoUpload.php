<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoUpload extends Model
{
    protected $table = 'video_uploads';

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
