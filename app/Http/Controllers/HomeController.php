<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Event; // Assuming you have an Event model

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::with('categories')->take(4)->get(); // Fetch first 4 items
        $events = Event::with('categories')->take(4)->get(); // Fetch first 4 events

        return view('home', compact('categories', 'items', 'events'));
    }

    public function filterItems($categoryId)
    {
        if ($categoryId == 'all') {
            $items = Item::take(4)->get();
        } else {
            $items = Item::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })->take(3)->get();
        }

        return response()->json(['items' => $items]);
    }

    public function filterEvents($categoryId)
    {
        if ($categoryId == 'all') {
            $events = Event::take(4)->get();
        } else {
            $events = Event::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })->take(4)->get();
        }

        return response()->json(['events' => $events]);
    }

    public function thingsToDo()
    {
        $categories = Category::all();
        $items = Item::with('categories')->take(8)->get(); // Fetch first 8 items

        return view('thingstodo', compact('categories', 'items'));
    }

    public function happenings()
    {
        $categories = Category::all();
        $events = Event::with('categories')->take(8)->get(); // Fetch first 8 items

        return view('happenings', compact('categories', 'events'));
    }


}
