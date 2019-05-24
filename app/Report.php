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
        'category_id',
    ];

    protected $casts = [
        'videos' => 'array',
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'report_tag');
    }
}
