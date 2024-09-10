<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'rating', 'review'];

    // A review belongs to an item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // A review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
