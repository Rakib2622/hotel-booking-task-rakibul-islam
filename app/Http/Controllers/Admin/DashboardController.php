<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RoomCategory;

class DashboardController extends Controller
{
    public function index()
    {
        // Total bookings
        $totalBookings = Booking::count();

        // Total categories
        $totalCategories = RoomCategory::count();

        // Total rooms (3 rooms per category, 3 categories)
        $totalRooms = 3 * 3;

        // Recent bookings with category
        $recentBookings = Booking::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalRooms',
            'totalCategories',
            'recentBookings'
        ));
    }
}
