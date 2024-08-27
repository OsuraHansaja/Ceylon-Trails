<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HostRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.host_register');  // The Blade view  for host registration
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $host = $this->create($request->all());

        auth()->guard('host')->login($host);  //  'host' guard

        return redirect()->route('host.dashboard');  // Redirect to host dashboard
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:hosts'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
//test comment
    protected function create(array $data)
    {
        return Host::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

