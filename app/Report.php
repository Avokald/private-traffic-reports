<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'description',
        'lat',
        'lng',
        'videos',
        'images',
    ];

    protected $casts = [
        'videos' => 'array',
        'images' => 'array',
    ];
}
