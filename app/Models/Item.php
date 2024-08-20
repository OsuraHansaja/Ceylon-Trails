<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title', 'small_description', 'location', 'link', 'thumbnail_image', 'cover_photo', 'large_description', 'host_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}

