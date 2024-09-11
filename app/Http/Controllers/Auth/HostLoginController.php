<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HostLoginController extends Controller
{
    protected $redirectTo = '/host/statboard';  // Redirect to the host dashboard

    public function showLoginForm()
    {
        return view('auth.host_login');  // View for host login form
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log in with the host guard
        if (Auth::guard('host')->attempt($request->only('email', 'password'))) {
            return redirect()->intended($this->redirectTo);  // Redirect to intended host dashboard
        }

        // If login fails, throw a validation exception
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('host')->logout();  // Log out from the host guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('host.login');  // Redirect to the host login page
    }
}
