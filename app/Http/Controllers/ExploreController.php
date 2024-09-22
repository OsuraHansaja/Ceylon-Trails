<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ExploreController extends Controller
{
    public function index()
    {
        return view('explore-sri-lanka'); // Reference the Blade view
    }

    // Function to get top 4 items for a selected district
    public function exploreSriLanka()
    {
        // Fetch default items for 'Colombo' when the page first loads
        $items = Item::where('location', 'Colombo')->take(4)->get();
        return view('explore-sri-lanka', compact('items'));
    }

    public function getItemsByDistrict($district)
    {
        // Fetch top 4 items based on the district clicked
        $items = Item::where('location', $district)->take(4)->get();

        // Return the data in JSON format for JavaScript to process
        return response()->json($items);
    }



}

