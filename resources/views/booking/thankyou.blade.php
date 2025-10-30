<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Confirmed</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto my-10 bg-white p-8 rounded shadow text-center">
    <h2 class="text-2xl font-bold mb-4">Thank You, {{ $booking->name }}!</h2>
    <p class="mb-2">Your booking has been confirmed.</p>

    <div class="mt-6 text-left">
        <p><strong>Room Category:</strong> {{ $booking->category->name }}</p>
        <p><strong>From:</strong> {{ $booking->from_date }}</p>
        <p><strong>To:</strong> {{ $booking->to_date }}</p>
        <p><strong>Base Price:</strong> {{ number_format($booking->base_price) }} BDT</p>
        <p><strong>Final Price:</strong> {{ number_format($booking->final_price) }} BDT</p>
    </div>

    <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Back to Home</a>
</div>

</body>
</html>
