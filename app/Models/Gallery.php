<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['item_id', 'image_path', 'is_thumbnail'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

