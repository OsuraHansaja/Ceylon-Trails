<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Host Registration
Route::get('host/register', [App\Http\Controllers\Auth\HostRegisterController::class, 'showRegistrationForm'])->name('host.register');
Route::post('host/register', [App\Http\Controllers\Auth\HostRegisterController::class, 'register']);

// Host Dashboard (to be created later)
Route::get('host/dashboard', [App\Http\Controllers\Host\DashboardController::class, 'index'])->name('host.dashboard')->middleware('auth:host');

// Host Login
Route::get('host/login', [App\Http\Controllers\Auth\HostLoginController::class, 'showLoginForm'])->name('host.login');
Route::post('host/login', [App\Http\Controllers\Auth\HostLoginController::class, 'login']);
Route::post('host/logout', [App\Http\Controllers\Auth\HostLoginController::class, 'logout'])->name('host.logout');

/*Route::group(['middleware' => ['auth:host']], function () {
    Route::get('/host/profile', function () {
        return view('profile.show');
    })->name('host.profile.show');

    Route::put('/host/profile-information', [\Laravel\Jetstream\Http\Controllers\Livewire\UpdateProfileInformationController::class, 'update'])
        ->name('host.user-profile-information.update');

    Route::put('/host/password', [\Laravel\Jetstream\Http\Controllers\Livewire\UpdatePasswordController::class, 'update'])
        ->name('host.user-password.update');
});*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
