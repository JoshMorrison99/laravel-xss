<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function submit(Request $request)
    {
        $search = $request->input('search');

        // Process form data
        return view('welcome', ['search' => $search]);
    }
}
