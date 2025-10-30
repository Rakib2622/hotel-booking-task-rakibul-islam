@extends('frontend.layout')

@section('title', 'Booking Confirmed')

@section('content')
<div class="container" style="max-width:700px; margin:50px auto;">

    <div style="background:white; padding:40px; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1); text-align:center;">
        <h2 style="font-size:2em; font-weight:bold; margin-bottom:20px; color:#004080;">
            Thank You, {{ $booking->name }}!
        </h2>
        <p style="font-size:1.1em; margin-bottom:30px;">Your booking has been successfully confirmed.</p>

        <div style="background:#f9f9f9; padding:20px; border-radius:10px; text-align:left; line-height:1.6; margin-bottom:30px;">
            <p><strong>Room Category:</strong> {{ $booking->category->name }}</p>
            <p><strong>From Date:</strong> {{ $booking->from_date }}</p>
            <p><strong>To Date:</strong> {{ $booking->to_date }}</p>
            <p><strong>Total Nights:</strong> {{ \Carbon\Carbon::parse($booking->from_date)->diffInDays(\Carbon\Carbon::parse($booking->to_date)) + 1 }}</p>
            <p><strong>Base Price per Night:</strong> {{ number_format($booking->category->base_price) }} BDT</p>
            <p><strong>Final Price:</strong> {{ number_format($booking->final_price) }} BDT</p>
        </div>

        <a href="{{ route('home') }}" 
           style="display:inline-block; background:#004080; color:white; padding:12px 25px; border-radius:8px; font-weight:bold; text-decoration:none; transition:0.3s;">
           Back to Home
        </a>
    </div>

</div>
@endsection
