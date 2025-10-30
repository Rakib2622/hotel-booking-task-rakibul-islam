<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book a Room</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* Reset & basic styles */
    body { margin:0; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f0f0f0; color:#333; }
    a { text-decoration:none; color:inherit; }

    /* Navbar */
    .navbar { background:#004080; color:white; padding:15px 20px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
    .navbar a { color:white; margin-left:20px; font-weight:bold; }
    .navbar a:hover { text-decoration:underline; }

    /* Container */
    .container { max-width:600px; margin:50px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,0.1); }

    h2 { text-align:center; color:#1a202c; margin-bottom:25px; font-size:2em; }
    label { font-weight:bold; display:block; margin-bottom:5px; color:#333; }
    input, select { width:100%; padding:10px 12px; margin-bottom:20px; border-radius:5px; border:1px solid #ccc; font-size:14px; transition: all 0.3s ease; }
    input:focus, select:focus { border-color:#007bff; outline:none; }

    .btn { background-color:#004080; color:white; padding:12px 20px; border:none; border-radius:5px; width:100%; font-size:16px; cursor:pointer; transition:all 0.3s ease; }
    .btn:hover { background-color:#0056b3; }

    .info-box { background:#f9fafb; padding:15px; border-left:4px solid #007bff; margin-bottom:20px; border-radius:5px; display:none; }
    .info-box p { margin:5px 0; font-weight:bold; }

    .error-box { background:#ffe6e6; color:#cc0000; padding:15px; border-radius:5px; margin-bottom:20px; }
    .error-box ul { padding-left:20px; }

    /* Footer */
    footer { background:#222; color:white; text-align:center; padding:20px; margin-top:40px; }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo"><a href="{{ route('home') }}" style="font-size:1.2em;">Hotel Booking</a></div>
    <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('admin.dashboard') }}">Admin</a>
        <a href="{{ route('booking.create') }}">Book a Room</a>
    </div>
</nav>

<!-- Booking Form Container -->
<div class="container">
    <h2>Book a Room</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>From Date</label>
        <input type="date" name="from_date" id="from_date" value="{{ old('from_date') }}">

        <label>To Date</label>
        <input type="date" name="to_date" id="to_date" value="{{ old('to_date') }}">

        <label>Room Category</label>
        <select name="room_category_id" id="room_category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }} - {{ number_format($category->base_price) }} BDT/night</option>
            @endforeach
        </select>

        <!-- Dynamic availability and price info -->
        <div id="category_info" class="info-box">
            <p id="availability_text"></p>
            <p id="price_text"></p>
        </div>

        <button type="submit" class="btn">Confirm Booking</button>
    </form>
</div>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} Hotel Booking System. All rights reserved.
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fromDate = document.getElementById('from_date');
    const toDate = document.getElementById('to_date');
    const roomSelect = document.getElementById('room_category');
    const infoDiv = document.getElementById('category_info');
    const availabilityText = document.getElementById('availability_text');
    const priceText = document.getElementById('price_text');
    let blockedDates = [];

    fetch("{{ route('booking.getBlockedDates') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => { blockedDates = data; });

    function disableBlocked(dateStr) { return blockedDates.includes(dateStr); }

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

    const previousValue = roomSelect.value; // preserve selected value

    fetch("{{ route('booking.getAvailableCategories') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ from_date: fromDate.value, to_date: toDate.value })
    })
    .then(res => res.json())
    .then(data => {
        infoDiv.style.display = 'block';
        roomSelect.innerHTML = '';

        let selectedOption = null;

        data.forEach(cat => {
            let option = document.createElement('option');
            option.value = cat.id;
            option.text = cat.name + ' - ' + cat.final_price + ' BDT';
            if (!cat.available) {
                option.disabled = true;
                option.text += ' (Fully booked)';
            }
            roomSelect.appendChild(option);

            // Determine which option should be selected
            if (cat.id == previousValue) {
                option.selected = true;
                selectedOption = cat;
            }
        });

        // If previous selection is not available, select the first available
        if (!selectedOption) {
            selectedOption = data.find(c => c.available) || data[0];
            roomSelect.value = selectedOption.id;
        }

        availabilityText.textContent = selectedOption.available ? 'Available' : 'Fully booked';
        priceText.textContent = 'Final Price: ' + selectedOption.final_price + ' BDT';
    });
}


    roomSelect.addEventListener('change', fetchCategories);
});
</script>

</body>
</html>
