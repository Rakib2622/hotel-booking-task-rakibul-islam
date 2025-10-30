<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book a Room</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto my-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Book a Room</h2>

    @if ($errors->any())
        <div class="bg-red-100 p-4 mb-4 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">From Date</label>
            <input type="date" name="from_date" id="from_date" value="{{ old('from_date') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">To Date</label>
            <input type="date" name="to_date" id="to_date" value="{{ old('to_date') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Room Category</label>
            <select name="room_category_id" id="room_category" class="w-full p-2 border rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} - {{ number_format($category->base_price) }} BDT/night</option>
                @endforeach
            </select>
        </div>

        <!-- Dynamic availability and price info -->
        <div id="category_info" class="mt-4 p-4 bg-gray-100 rounded hidden">
            <p id="availability_text" class="font-semibold"></p>
            <p id="price_text" class="font-semibold"></p>
        </div>

        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Confirm Booking</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fromDate = document.getElementById('from_date');
    const toDate = document.getElementById('to_date');
    const roomSelect = document.getElementById('room_category');
    const infoDiv = document.getElementById('category_info');
    const availabilityText = document.getElementById('availability_text');
    const priceText = document.getElementById('price_text');

    let blockedDates = [];

    // Fetch fully booked dates on page load
    fetch("{{ route('booking.getBlockedDates') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => { blockedDates = data; });

    function disableBlocked(dateStr) {
        return blockedDates.includes(dateStr);
    }

    function setMinMaxDates(input) {
        const today = new Date().toISOString().split('T')[0];
        input.setAttribute('min', today);
    }

    setMinMaxDates(fromDate);
    setMinMaxDates(toDate);

    fromDate.addEventListener('input', function() {
        if(disableBlocked(fromDate.value)){
            alert('Selected date is fully booked. Please choose another date.');
            fromDate.value = '';
        }
        fetchCategories();
    });

    toDate.addEventListener('input', function() {
        if(disableBlocked(toDate.value)){
            alert('Selected date is fully booked. Please choose another date.');
            toDate.value = '';
        }
        fetchCategories();
    });

    function fetchCategories() {
        if (!fromDate.value || !toDate.value) return;

        fetch("{{ route('booking.getAvailableCategories') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                from_date: fromDate.value,
                to_date: toDate.value
            })
        })
        .then(res => res.json())
        .then(data => {
            infoDiv.classList.remove('hidden');
            roomSelect.innerHTML = '';
            data.forEach(cat => {
                let option = document.createElement('option');
                option.value = cat.id;
                option.text = cat.name + ' - ' + cat.final_price + ' BDT';
                if (!cat.available) {
                    option.disabled = true;
                    option.text += ' (Fully booked)';
                }
                roomSelect.appendChild(option);
            });

            const selected = data.find(c => c.id == roomSelect.value) || data[0];
            availabilityText.textContent = selected.available ? 'Available' : 'Fully booked';
            priceText.textContent = 'Final Price: ' + selected.final_price + ' BDT';
        });
    }

    roomSelect.addEventListener('change', fetchCategories);
});
</script>

</body>
</html>
