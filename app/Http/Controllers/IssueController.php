<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportIssue;

class IssueController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'issue' => 'required|string',
            'email' => 'nullable|email',
        ]);

        ReportIssue::create([
            'issue' => $request->input('issue'),
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Issue reported successfully!');
    }
}
