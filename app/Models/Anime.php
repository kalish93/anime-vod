<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        "mal_id",
        "titles"
    ];
    protected $casts = [
        'titles' => 'array'
    ];
}
