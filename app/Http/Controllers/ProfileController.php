<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $savedItems = $user->savedItems()->take(8)->get(); // Fetch the first 8 saved items

        return view('profile.profile', compact('user', 'savedItems'));
    }

    public function edit()
    {
        $user = auth()->user();
        $categories = Category::all(); // Get all categories for the preference section
        return view('profile.edit_profile', compact('user', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'categories' => 'required|array|min:1', // Require at least one category to be selected
        ]);

        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->save();

        // Update categories (detach all and then attach selected)
        $user->categories()->sync($request->categories);

        return redirect()->route('profile.profile')->with('status', 'Profile updated successfully!');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'delete_password' => 'required',
        ]);

        $user = auth()->user();

        // Check if the entered password is correct
        if (!Hash::check($request->delete_password, $user->password)) {
            return back()->withErrors(['delete_password' => 'Incorrect password. Please try again.']);
        }

        // Delete the user
        $user->delete();

        // Log out the user and redirect to the home page
        auth()->logout();

        return redirect('/')->with('status', 'Your account has been deleted successfully.');
    }
}
