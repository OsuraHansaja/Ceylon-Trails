<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Category;

class AttractionController extends Controller
{
    // Display the form to create a new attraction
    public function create()
    {
        $categories = Category::all();
        return view('host.items.create-attraction', compact('categories'));
    }

    // Handle the form submission and store the new attraction
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'large_description' => 'required|string',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the thumbnail image
        if ($request->hasFile('thumbnail_image')) {
            $validatedData['thumbnail_image'] = $request->file('thumbnail_image')->store('thumbnails');
        }

        // Store the cover photo if uploaded
        if ($request->hasFile('cover_photo')) {
            $validatedData['cover_photo'] = $request->file('cover_photo')->store('cover_photos');
        }

        // Store the attraction in the database
        $attraction = Attraction::create($validatedData);

        // Attach the selected categories to the attraction
        $attraction->categories()->attach($request->categories);

        // Store gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $attraction->gallery()->create(['path' => $image->store('galleries')]);
            }
        }

        return redirect()->route('host.dashboard')->with('success', 'Attraction created successfully!');
    }
}
