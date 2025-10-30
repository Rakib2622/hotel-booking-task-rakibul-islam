@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-100 p-4 rounded shadow">
        <h2 class="font-bold">Total Bookings</h2>
        <p class="text-xl">{{ $totalBookings }}</p>
    </div>
    <div class="bg-green-100 p-4 rounded shadow">
        <h2 class="font-bold">Total Rooms</h2>
        <p class="text-xl">{{ $totalRooms }}</p>
    </div>
</div>

<h2 class="text-xl font-bold mb-2">Recent Bookings</h2>
<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">Name</th>
            <th class="border px-2 py-1">Category</th>
            <th class="border px-2 py-1">From</th>
            <th class="border px-2 py-1">To</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentBookings as $b)
        <tr>
            <td class="border px-2 py-1">{{ $b->id }}</td>
            <td class="border px-2 py-1">{{ $b->name }}</td>
            <td class="border px-2 py-1">{{ $b->category->name }}</td>
            <td class="border px-2 py-1">{{ $b->from_date }}</td>
            <td class="border px-2 py-1">{{ $b->to_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
