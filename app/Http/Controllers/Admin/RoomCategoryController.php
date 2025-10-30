<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomCategory;

class RoomCategoryController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::all();
        return view('admin.room_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.room_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
        ]);

        RoomCategory::create($request->all());
        return redirect()->route('admin.room-categories.index')->with('success', 'Room category created.');
    }

    public function edit(RoomCategory $roomCategory)
    {
        return view('admin.room_categories.edit', compact('roomCategory'));
    }

    public function update(Request $request, RoomCategory $roomCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
        ]);

        $roomCategory->update($request->all());
        return redirect()->route('admin.room-categories.index')->with('success', 'Room category updated.');
    }

    public function destroy(RoomCategory $roomCategory)
    {
        $roomCategory->delete();
        return redirect()->route('admin.room-categories.index')->with('success', 'Room category deleted.');
    }
}
