<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Arts & Culture',
            'History',
            'Food & Beverages',
            'Nature',
            'Wild Life',
            'Shopping',
            'Sports',
            'Music',
            'Family Fun',
            'Wellness',
            'Hiking & Trekking',
            'Religious & Spiritual',
            'Festivals',
            'City Life',
            'Night Life'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

