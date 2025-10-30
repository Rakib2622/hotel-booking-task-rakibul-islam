<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalRooms = 3 * 3; // example: 3 rooms per category, 3 categories
        $recentBookings = Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBookings', 'totalRooms', 'recentBookings'));
    }
}

