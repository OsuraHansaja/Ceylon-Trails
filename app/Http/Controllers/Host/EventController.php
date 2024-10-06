<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        // Handle gallery image 1 upload
        if ($request->hasFile('gallery_image_1')) {
            $galleryImage1Path = $request->file('gallery_image_1')->store('gallery_images', 'public');
            $event->gallery_image_1 = $galleryImage1Path;
        }

        // Handle gallery image 2 upload
        if ($request->hasFile('gallery_image_2')) {
            $galleryImage2Path = $request->file('gallery_image_2')->store('gallery_images', 'public');
            $event->gallery_image_2 = $galleryImage2Path;
        }

        // Handle gallery image 3 upload
        if ($request->hasFile('gallery_image_3')) {
            $galleryImage3Path = $request->file('gallery_image_3')->store('gallery_images', 'public');
            $event->gallery_image_3 = $galleryImage3Path;
        }

        // Handle gallery image 4 upload
        if ($request->hasFile('gallery_image_4')) {
            $galleryImage4Path = $request->file('gallery_image_4')->store('gallery_images', 'public');
            $event->gallery_image_4 = $galleryImage4Path;
        }

        // Save the event
        $event->save();

        // Manually Insert Categories into the category_event pivot table
        $categories = $request->input('category_ids'); // Get selected categories

        // Insert categories into pivot table manually
        foreach ($request->input('category_ids') as $categoryId) {
            DB::table('category_event')->insert([
                'category_id' => (int)$categoryId,
                'event_id' => $event->id,
            ]);
        }


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
            'gallery_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        // Get selected categories
        $categories = $request->input('category_ids');

        // Delete existing categories for the item in the pivot table
        DB::table('category_event')->where('event_id', $event->id)->delete();

        // Manually Insert Categories into the category_event pivot table
        $categories = $request->input('category_ids'); // Get selected categories

        // Insert categories into pivot table manually
        foreach ($request->input('category_ids') as $categoryId) {
            DB::table('category_event')->insert([
                'category_id' => (int)$categoryId,
                'event_id' => $event->id,
            ]);
        }

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

    public function showDetails($id)
    {
        $event = Event::with('categories')->findOrFail($id);
        return view('event.details', compact('event'));
    }

    public function filterEvents($categoryId)
    {
        if ($categoryId === 'all') {
            $events = Event::with('categories')->take(4)->get();
        } else {
            $events = Event::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })->with('categories')->take(4)->get();
        }

        return response()->json($events);
    }


    public function filterHappeningsPaginated(Request $request)
    {
        $categoryId = $request->get('category_id');
        $year = $request->get('year');
        $month = $request->get('month');
        $offset = $request->get('offset', 0);

        $query = Event::whereYear('start_date', $year)->whereMonth('start_date', $month);

        // Check if the category is not 'all' and add the category filtering
        if ($categoryId !== 'all') {
            $query->whereHas('categories', function($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Load events with pagination and category filtering
        $events = $query->with('categories')->skip($offset)->take(8)->get();

        return response()->json($events);
    }






}
