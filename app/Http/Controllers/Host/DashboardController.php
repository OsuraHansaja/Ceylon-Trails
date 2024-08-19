<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('host.dashboard');  // This will reference the Blade view for the host dashboard
    }
}

