@extends('admin.layout')

@section('content')
<h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">Booking Details</h1>

<div style="background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.1); max-width:600px; margin:auto;">
    
    <h2 style="font-size:20px; font-weight:bold; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:5px;">Booking Info</h2>
    
    <p><strong>Booking ID:</strong> <span style="color:#2980b9;">{{ $booking->id }}</span></p>
    <p><strong>Name:</strong> {{ $booking->name }}</p>
    <p><strong>Email:</strong> {{ $booking->email }}</p>
    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
    <p><strong>Room Category:</strong> {{ $booking->category->name }}</p>
    <p><strong>From Date:</strong> {{ $booking->from_date }}</p>
    <p><strong>To Date:</strong> {{ $booking->to_date }}</p>
    <p><strong>Total Nights:</strong> {{ \Carbon\Carbon::parse($booking->from_date)->diffInDays(\Carbon\Carbon::parse($booking->to_date)) + 1 }}</p>

    <h2 style="font-size:20px; font-weight:bold; margin:20px 0 10px; border-bottom:1px solid #eee; padding-bottom:5px;">Pricing</h2>
    <p><strong>Base Price per Night:</strong> <span style="color:#27ae60;">{{ number_format($booking->category->base_price) }} BDT</span></p>
    <p><strong>Final Price:</strong> <span style="color:#e74c3c; font-weight:bold;">{{ number_format($booking->final_price) }} BDT</span></p>

    <div style="margin-top:25px; text-align:center;">
        <a href="{{ route('admin.bookings.index') }}" 
           style="background:#34495e; color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none; transition:0.3s;"
           onmouseover="this.style.background='#2c3e50';" 
           onmouseout="this.style.background='#34495e';">
           Back to Bookings
        </a>
    </div>
</div>
@endsection
