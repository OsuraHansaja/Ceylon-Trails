<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // Fetch events for the current host user
        $events = Event::where('host_id', auth()->id())->get();
        return view('host.dashboard', compact('events'));
    }

    public function create(Request $request)
    {
        // Fetch categories for the dropdown
        $categories = Category::all();

        return view('host.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        /*$validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
        ]);*/


        // Create a new event
        $event = new Event();
        $event->title = $request->title;
        $event->small_description = $request->small_description;
        $event->location = $request->location;
        $event->link = $request->link;
        $event->large_description = $request->large_description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->host_id = auth()->id(); // Associate with the current host

        // Handle file upload
        if ($request->hasFile('thumbnail_image')) {
            $filename = time() . '.' . $request->thumbnail_image->extension();
            $request->thumbnail_image->move(public_path('thumbnails'), $filename); // Move the uploaded file
            $event->thumbnail_image = 'thumbnails/' . $filename; // Save the file path in the database
        }

        // Save the event
        $event->save();

        // Sync categories
        $event->categories()->attach($request->category_ids);

        return redirect()->route('host.dashboard')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {

        // Fetch categories for the dropdown
        $categories = Category::all();

        return view('host.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
/*
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
        ]);*/

        // Update the event details
        $event->title = $request->title;
        $event->small_description = $request->small_description;
        $event->location = $request->location;
        $event->link = $request->link;
        $event->large_description = $request->large_description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->save();

        // Sync categories
        $event->categories()->sync($request->category_ids);

        return redirect()->route('host.dashboard')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Ensure the current user is the owner of the event
        if ($event->host_id !== auth()->id()) {
            return redirect()->route('host.events.index')->with('error', 'Unauthorized access.');
        }

        // Delete the event
        $event->delete();

        return redirect()->route('host.dashboard')->with('success', 'Event deleted successfully.');
    }
}
