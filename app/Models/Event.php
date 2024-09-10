<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'small_description',
        'location',
        'link',
        'thumbnail_image',
        'gallery_image_1',
        'gallery_image_2',
        'large_description',
        'host_id',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];


    // Relationship with User (host)
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    // Relationship with categories (if events have multiple categories)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }
}
