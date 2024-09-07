<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        return view('host.dashboard');  // This will reference the Blade view for the host dashboard
    }

    public function updateProfile(Request $request)
    {
        $host = auth()->guard('host')->user(); // Retrieve the logged-in host

        // Check which form was submitted based on the input names
        if ($request->has('profile_picture')) {
            // Validate and update profile picture
            $request->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('profile_picture')) {
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $host->profile_picture = $imagePath;
            }
        }

        if ($request->has('website_url')) {
            // Validate and update website URL
            $request->validate([
                'website_url' => 'nullable|url',
            ]);
            $host->website_url = $request->input('website_url');
        }

        if ($request->has('instagram_url') || $request->has('facebook_url')) {
            // Validate and update social media links
            $request->validate([
                'instagram_url' => 'nullable|url',
                'facebook_url' => 'nullable|url',
            ]);

            $host->instagram_url = $request->input('instagram_url');
            $host->facebook_url = $request->input('facebook_url');
        }

        if ($request->has('bio')) {
            // Validate and update bio
            $request->validate([
                'bio' => 'nullable|string|max:250',
            ]);
            $host->bio = $request->input('bio');
        }

        // Save updated host profile
        $host->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}

