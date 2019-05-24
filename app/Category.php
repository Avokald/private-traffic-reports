<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'description',
        'marker_url',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
