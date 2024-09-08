<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Standard User Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Host Registration
Route::get('host/register', [App\Http\Controllers\Auth\HostRegisterController::class, 'showRegistrationForm'])->name('host.register');
Route::post('host/register', [App\Http\Controllers\Auth\HostRegisterController::class, 'register']);

// Host Dashboard
Route::get('host/dashboard', [App\Http\Controllers\Host\DashboardController::class, 'index'])->name('host.dashboard')->middleware('auth:host');

// Host Login
Route::get('host/login', [App\Http\Controllers\Auth\HostLoginController::class, 'showLoginForm'])->name('host.login');
Route::post('host/login', [App\Http\Controllers\Auth\HostLoginController::class, 'login']);
Route::post('host/logout', [App\Http\Controllers\Auth\HostLoginController::class, 'logout'])->name('host.logout');

// Host Profile
Route::get('/host/profile', function () {
    return view('host.profile');
})->name('host.profile')->middleware('auth:host');

// Route for updating the profile (profile picture, website, bio, etc.)
Route::post('/host/profile', [App\Http\Controllers\Host\DashboardController::class, 'updateProfile'])->name('host.profile.update')->middleware('auth:host');

// Route for updating username
Route::put('/host/profile/update-username', function (Request $request) {
    $request->validate([
        'username' => ['required', 'string', 'max:255'],
    ]);

    $user = Auth::guard('host')->user();
    $user->username = $request->username;
    $user->save();

    return redirect()->route('host.profile')->with('status', 'Username updated successfully!');
})->name('host.profile.update-username')->middleware('auth:host');

// Route for updating password
Route::put('/host/profile/update-password', function (Request $request) {
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = Auth::guard('host')->user();

    // Check if the current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Update the password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('host.profile')->with('status', 'Password updated successfully!');
})->name('host.profile.update-password')->middleware('auth:host');

// Routes for Creating and Managing Attractions
use App\Http\Controllers\Host\ItemController;
use App\Http\Controllers\Host\EventController;
use App\Http\Controllers\Host\DashboardController;
/*
Route::middleware(['auth:host'])->prefix('host')->name('host.')->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::get('/items/create/{type}', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
});

// Routes for editing and updating item (Attractions)
Route::get('/host/items/{item}/edit', [ItemController::class, 'edit'])->name('host.items.edit');
Route::put('/host/items/{item}', [ItemController::class, 'update'])->name('host.items.update');*/
/*
// Events Routes

Route::middleware(['auth:host'])->prefix('host')->name('host.')->group(function () {
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    Route::get('events/create/{type}', [EventController::class, 'create'])->name('events.create');
    Route::post('events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('host.events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('host.events.update');
    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});*/

Route::middleware(['auth:host'])->group(function () {
    Route::get('/host/dashboard', [DashboardController::class, 'index'])->name('host.dashboard');

    // Routes for events
    Route::get('/host/events/create', [EventController::class, 'create'])->name('host.events.create');
    Route::post('/host/events/store', [EventController::class, 'store'])->name('host.events.store');
    Route::get('/host/events/{event}/edit', [EventController::class, 'edit'])->name('host.events.edit');
    Route::put('/host/events/{event}', [EventController::class, 'update'])->name('host.events.update');
    Route::delete('/host/events/{event}', [EventController::class, 'destroy'])->name('host.events.destroy');

    // Routes for items
    Route::get('/host/items/create/{type}', [ItemController::class, 'create'])->name('host.items.create');
    Route::post('/host/items/store', [ItemController::class, 'store'])->name('host.items.store');
    Route::get('/host/items/{item}/edit', [ItemController::class, 'edit'])->name('host.items.edit');
    Route::put('/host/items/{item}', [ItemController::class, 'update'])->name('host.items.update');
    Route::delete('/host/items/{item}', [ItemController::class, 'destroy'])->name('host.items.destroy');
});




// Middleware for user authentication
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
