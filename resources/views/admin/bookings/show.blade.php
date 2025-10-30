@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Booking Details</h1>

<div class="bg-white p-6 rounded shadow">
    <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
    <p><strong>Name:</strong> {{ $booking->name }}</p>
    <p><strong>Email:</strong> {{ $booking->email }}</p>
    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
    <p><strong>Room Category:</strong> {{ $booking->category->name }}</p>
    <p><strong>From Date:</strong> {{ $booking->from_date }}</p>
    <p><strong>To Date:</strong> {{ $booking->to_date }}</p>
    <p><strong>Total Nights:</strong> {{ \Carbon\Carbon::parse($booking->from_date)->diffInDays(\Carbon\Carbon::parse($booking->to_date)) + 1 }}</p>
    <p><strong>Base Price per Night:</strong> {{ number_format($booking->category->base_price) }} BDT</p>
    <p><strong>Final Price:</strong> {{ number_format($booking->final_price) }} BDT</p>

    <div class="mt-4">
        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Bookings</a>
    </div>
</div>
@endsection
