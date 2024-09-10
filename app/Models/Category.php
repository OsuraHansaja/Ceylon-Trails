<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }
}

