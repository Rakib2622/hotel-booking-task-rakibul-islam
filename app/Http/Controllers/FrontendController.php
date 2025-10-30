<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomCategory;

class FrontendController extends Controller
{
    // Home page
    public function index()
    {
        // Optionally fetch room categories for display
        $categories = RoomCategory::all();

        return view('frontend.home', compact('categories'));
    }
}

