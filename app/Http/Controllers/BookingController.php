<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomCategory;
use App\Models\Booking;
use App\Models\DailyAvailability;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Show booking form
    public function create()
    {
        $categories = RoomCategory::all();
        return view('booking.create', compact('categories'));
    }

    // Handle booking form submission
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'room_category_id' => 'required|exists:room_categories,id',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $category = RoomCategory::findOrFail($request->room_category_id);
        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);
        $nights = $to->diffInDays($from) + 1;

        // Calculate total price
        $totalBasePrice = 0;
        for ($date = $from; $date->lte($to); $date->addDay()) {
            $dayPrice = $category->base_price;

            // Weekend surcharge (Friday=5, Saturday=6)
            if ($date->dayOfWeek == Carbon::FRIDAY || $date->dayOfWeek == Carbon::SATURDAY) {
                $dayPrice += $dayPrice * 0.2;
            }

            $totalBasePrice += $dayPrice;
        }

        // Apply 10% discount if booking 3+ nights
        $finalPrice = $totalBasePrice;
        if ($nights >= 3) {
            $finalPrice = $totalBasePrice * 0.9;
        }

        // Check availability for each day
        for ($date = clone $from; $date->lte($to); $date->addDay()) {
            $availability = DailyAvailability::firstOrCreate(
                ['room_category_id' => $category->id, 'date' => $date->format('Y-m-d')],
                ['booked_rooms' => 0]
            );

            if ($availability->booked_rooms >= 3) {
                return back()->withErrors(['availability' => 'No rooms available for ' . $category->name . ' on ' . $date->format('Y-m-d')]);
            }
        }

        // Create booking
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'room_category_id' => $category->id,
            'from_date' => $from->format('Y-m-d'),
            'to_date' => $to->format('Y-m-d'),
            'base_price' => $totalBasePrice,
            'final_price' => $finalPrice,
            'status' => 'confirmed'
        ]);

        // Update daily availability
        for ($date = clone $from; $date->lte($to); $date->addDay()) {
            $availability = DailyAvailability::firstOrCreate(
                ['room_category_id' => $category->id, 'date' => $date->format('Y-m-d')],
                ['booked_rooms' => 0]
            );
            $availability->increment('booked_rooms');
        }

        return redirect()->route('booking.thankyou', $booking->id);
    }

    // Show Thank You page
    public function thankYou($id)
    {
        $booking = Booking::with('category')->findOrFail($id);
        return view('booking.thankyou', compact('booking'));
    }

    // AJAX: Check availability for selected category and dates
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'room_category_id' => 'required|exists:room_categories,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $category = RoomCategory::findOrFail($request->room_category_id);
        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);
        $available = true;

        for ($date = $from; $date->lte($to); $date->addDay()) {
            $availability = DailyAvailability::where('room_category_id', $category->id)
                ->where('date', $date->format('Y-m-d'))
                ->first();

            if ($availability && $availability->booked_rooms >= 3) {
                $available = false;
                break;
            }
        }

        return response()->json(['available' => $available]);
    }

    // AJAX: Get available categories for selected dates
    public function getAvailableCategories(Request $request)
{
    $request->validate([
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $from = Carbon::parse($request->from_date);
    $to = Carbon::parse($request->to_date);

    $categories = RoomCategory::all()->map(function ($category) use ($from, $to) {
        $total = 0;
        $available = true;

        for ($date = clone $from; $date->lte($to); $date->addDay()) {
            $dayPrice = $category->base_price;

            // Weekend surcharge
            if ($date->dayOfWeek == Carbon::FRIDAY || $date->dayOfWeek == Carbon::SATURDAY) {
                $dayPrice += $dayPrice * 0.2;
            }

            $total += $dayPrice;

            // Check availability
            $availability = DailyAvailability::where('room_category_id', $category->id)
                ->where('date', $date->format('Y-m-d'))
                ->first();

            if ($availability && $availability->booked_rooms >= 3) {
                $available = false;
            }
        }

        // Apply discount
        if (($to->diffInDays($from) + 1) >= 3) {
            $total *= 0.9;
        }

        return [
            'id' => $category->id,
            'name' => $category->name,
            'available' => $available,
            'base_price' => $category->base_price,
            'final_price' => round($total),
        ];
    });

    return response()->json($categories);
}

public function getBlockedDates(Request $request)
{
    // Get all fully booked dates for all categories
    $blockedDates = DailyAvailability::select('date')
        ->groupBy('date')
        ->havingRaw('SUM(booked_rooms) >= 9') // 3 rooms * 3 categories
        ->pluck('date');

    return response()->json($blockedDates);
}


}

