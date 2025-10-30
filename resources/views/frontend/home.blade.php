<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-blue-700 text-white p-6">
        <h1 class="text-3xl font-bold">Welcome to Our Hotel</h1>
        <p class="mt-2">Book your perfect stay with us</p>
    </header>

    <!-- Room Categories -->
    <section class="max-w-6xl mx-auto my-10">
        <h2 class="text-2xl font-semibold mb-6">Room Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-700 mb-2">Base Price: {{ number_format($category->base_price) }} BDT / night</p>
                    <a href="{{ route('booking.create') }}" class="inline-block mt-2 px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">Book Now</a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4">
        &copy; {{ date('Y') }} Hotel Booking System. All rights reserved.
    </footer>

</body>
</html>
