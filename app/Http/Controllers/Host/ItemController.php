<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;



class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('host_id', auth()->id())->get();
        return view('host.dashboard', compact('items'));
    }


    public function create(Request $request)
    {
        $categories = Category::all();
        return view('host.items.create', compact('categories'));
    }

//test

    public function store(Request $request)
    {
        /*dd($request->all()); // This will dump all the form data and stop the execution, for debugging */

        /*$request->validate([
            //'title' => 'required|string|max:255',
            //'small_description' => 'required|string',
            //'location' => 'required|string|max:255',
            //'link' => 'nullable|url',
            //'categories' => 'required|array',
            //'categories.*' => 'exists:categories,id',
            //'large_description' => 'required|string',
            //'thumbnail_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'gallery_image_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate for gallery image 1
            //'gallery_image_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate for gallery image 2
    ]);

        ]); */

        $item = new Item();
        $item->title = $request->title;
        $item->small_description = $request->small_description;
        $item->location = $request->location;
        $item->link = $request->link;
        $item->large_description = $request->large_description;
        $item->host_id = auth()->id();

        /* Handle file upload
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $filename = $image->hashName();

            // Resize the image
            $img = Image::make($image->path());
            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(storage_path('app/public/thumbnails/' . $filename));

            $item->thumbnail_image = 'thumbnails/' . $filename;
        } */

        // Handle file upload
        if ($request->hasFile('thumbnail_image')) {
            $filename = time() . '.' . $request->thumbnail_image->extension();
            $request->thumbnail_image->move(public_path('thumbnails'), $filename); // Move the uploaded file
            $item->thumbnail_image = 'thumbnails/' . $filename; // Save the file path in the database
        }

        // Handle gallery image 1 upload
        if ($request->hasFile('gallery_image_1')) {
            $galleryImage1Path = $request->file('gallery_image_1')->store('gallery_images', 'public');
            $item->gallery_image_1 = $galleryImage1Path;
        }

        // Handle gallery image 2 upload
        if ($request->hasFile('gallery_image_2')) {
            $galleryImage2Path = $request->file('gallery_image_2')->store('gallery_images', 'public');
            $item->gallery_image_2 = $galleryImage2Path;
        }

        // Handle gallery image 3 upload
        if ($request->hasFile('gallery_image_3')) {
            $galleryImage3Path = $request->file('gallery_image_3')->store('gallery_images', 'public');
            $item->gallery_image_3 = $galleryImage3Path;
        }

        // Handle gallery image 4 upload
        if ($request->hasFile('gallery_image_4')) {
            $galleryImage4Path = $request->file('gallery_image_4')->store('gallery_images', 'public');
            $item->gallery_image_4 = $galleryImage4Path;
        }

        $item->save();

        /*// Debug the categories before attaching
        dd($request->category_ids);*/


        //dd($categoryIdsArray); This will dump all the form data and stop the execution, for debugging

        // Manually Insert Categories into the category_item pivot table
        $categories = $request->input('category_ids'); // Get selected categories

        // Insert categories into the pivot table manually
        foreach ($request->input('category_ids') as $categoryId) {
            DB::table('category_item')->insert([
                'category_id' => (int) $categoryId,
                'item_id' => $item->id,
            ]);
        }


        // Redirect to dashboard with success message
        return redirect()->route('host.dashboard')->with('status', 'Attraction created successfully!');
    }


    /*public function show(Item $item)
    {
        return view('host.items.show', compact('item'));
    }*/
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('host.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        /*$request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_ids' => 'required|array',
            'large_description' => 'required|string',
        ]);*/

        // Update item details
        $item->title = $request->title;
        $item->small_description = $request->small_description;
        $item->location = $request->location;
        $item->link = $request->link;
        $item->large_description = $request->large_description;
        $item->save();

        // Get selected categories
        $categories = $request->input('category_ids');

        // Delete existing categories for the item in the pivot table
        DB::table('category_item')->where('item_id', $item->id)->delete();

        // Manually Insert Categories into the category_item pivot table
        $categories = $request->input('category_ids'); // Get selected categories

        // Insert categories into the pivot table manually
        foreach ($request->input('category_ids') as $categoryId) {
            DB::table('category_item')->insert([
                'category_id' => (int) $categoryId,
                'item_id' => $item->id,
            ]);
        }

        return redirect()->route('host.dashboard')->with('status', 'Attraction updated successfully!');
    }

    public function destroy(Item $item)
    {
        // Ensuring the item belongs to the authenticated host
        if ($item->host_id !== auth()->id()) {
            abort(403, 'Forbidden');
        }

        $item->delete();

        return redirect()->route('host.dashboard')->with('status', 'Item deleted successfully!');
    }

    public function showDetails($id)
    {
        $item = Item::with('categories', 'host')->findOrFail($id); // Fetch the item with its categories
        return view('item.details', compact('item')); // Pass the item to the view
    }

    public function filterItems($categoryId)
    {
        if ($categoryId === 'all') {
            $items = Item::with('categories')->take(4)->get();
        } else {
            $items = Item::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })->with('categories')->take(4)->get();
        }

        return response()->json($items);
    }

    public function filterItemsPaginated(Request $request)
    {
        $categoryId = $request->category_id;
        $offset = $request->offset ?? 0;

        if ($categoryId === 'all') {
            // Load all items paginated by 8
            $items = Item::with('categories')->skip($offset)->take(8)->get();
        } else {
            // Load items by category paginated by 8
            $items = Item::whereHas('categories', function($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->skip($offset)->take(8)->with('categories')->get();
        }

        return response()->json($items);
    }

    public function saveItem($id)
    {
        $user = auth()->user();

        // Check if the item is already saved
        if ($user->savedItems()->where('item_id', $id)->exists()) {
            return redirect()->back()->with('error', 'Item already saved.');
        }

        // Save the item
        $user->savedItems()->attach($id);

        return redirect()->back()->with('success', 'Item saved successfully.');
    }


    public function removeItem(Item $item)
    {
        $user = auth()->user();
        $user->savedItems()->detach($item->id); // Remove the item from the saved items

        return redirect()->back()->with('success', 'Item removed successfully.');
    }




}

