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


    public function create($type)
    {
        $categories = Category::all();
        return view('host.items.create', compact('categories', 'type'));
    }


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
        ]); */

        $item = new Item();
        $item->title = $request->title;
        $item->small_description = $request->small_description;
        $item->location = $request->location;
        $item->link = $request->link;
        $item->large_description = $request->large_description;
        $item->host_id = auth()->id();
        $item->save();

        /*// Debug the categories before attaching
        dd($request->category_ids);*/

        // Convert the comma-separated string to an array
        $categoryIdsArray = explode(',', $request->category_ids);

        //dd($categoryIdsArray); This will dump all the form data and stop the execution, for debugging

        // Attach categories
        $item->categories()->attach($request->category_ids);

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

        // Sync categories
        $item->categories()->sync($request->category_ids);

        return redirect()->route('host.dashboard')->with('status', 'Attraction updated successfully!');
    }


}

