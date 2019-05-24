<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
        'description',
        'color',
    ];

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_tag');
    }

}
