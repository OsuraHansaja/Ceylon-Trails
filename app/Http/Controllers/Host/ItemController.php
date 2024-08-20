<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Gallery;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('host_id', auth()->id())->get();
        return view('host.dashboard', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('host.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url',
            'thumbnail_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'large_description' => 'required|string',
            'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $item = new Item();
        $item->title = $request->title;
        $item->small_description = $request->small_description;
        $item->location = $request->location;
        $item->link = $request->link;
        $item->large_description = $request->large_description;
        $item->host_id = auth()->id();
        $item->save();

        // Attach categories
        $item->categories()->attach($request->categories);

        // Store the thumbnail image
        if ($request->hasFile('thumbnail_image')) {
            $thumbnailPath = $request->file('thumbnail_image')->store('items/thumbnails', 'public');
            $item->thumbnail_image = $thumbnailPath;
            $item->save();

            // Save the thumbnail as part of the gallery
            $gallery = new Gallery();
            $gallery->item_id = $item->id;
            $gallery->image_path = $thumbnailPath;
            $gallery->is_thumbnail = true;
            $gallery->save();
        }

        // Store the cover photo
        if ($request->hasFile('cover_photo')) {
            $coverPhotoPath = $request->file('cover_photo')->store('items/covers', 'public');
            $item->cover_photo = $coverPhotoPath;
            $item->save();
        }

        // Store additional gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $imagePath = $image->store('items/gallery', 'public');

                $gallery = new Gallery();
                $gallery->item_id = $item->id;
                $gallery->image_path = $imagePath;
                $gallery->save();
            }
        }

        return redirect()->route('host.dashboard')->with('status', 'Attraction created successfully!');
    }

    public function show(Item $item)
    {
        return view('host.items.show', compact('item'));
    }
}

