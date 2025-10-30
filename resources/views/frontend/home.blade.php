@extends('frontend.layout')

@section('title', 'Welcome to Our Hotel')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <h1>Welcome to Our Hotel</h1>
    <p>Book your perfect stay with us</p>
    <a href="{{ route('booking.create') }}" class="btn-primary">Book Now</a>
</section>

<!-- Room Categories -->
<section class="container">
    <h2 class="section-title">Room Categories</h2>
    <div class="room-grid">
        @foreach($categories as $category)
            <div class="room-card">
                <h3>{{ $category->name }}</h3>
                <p>Base Price: {{ number_format($category->base_price) }} BDT / night</p>
                <a href="{{ route('booking.create') }}" class="btn-primary">Book Now</a>
            </div>
        @endforeach
    </div>
</section>

@endsection
