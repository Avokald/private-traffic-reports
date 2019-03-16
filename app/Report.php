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
    ];

    protected $casts = [
        'videos' => 'array',
    ];
}
