<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    protected $fillable = [
        'title', 'small_description', 'location', 'link', 'large_description', 'host_id', 'thumbnail_image', 'gallery_image_1', 'gallery_image_2', 'gallery_image_3', 'gallery_image_4',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }



}
//This is the model for the Attractions, it was incorrectly named Item and has remained so due to inability to adjust this late.
