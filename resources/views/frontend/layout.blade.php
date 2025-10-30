<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Booking System')</title>
    <style>
        /* Reset & basic styles */
        body { margin:0; font-family: 'Arial', sans-serif; background:#f0f0f0; color:#333; }
        a { text-decoration: none; color: inherit; }

        /* Navbar */
        .navbar { background:#004080; color:white; padding:15px 20px; display:flex; justify-content:space-between; align-items:center; }
        .navbar a { color:white; margin-left:20px; font-weight:bold; }
        .navbar a:hover { text-decoration: underline; }

        /* Hero section */
        .hero { background: linear-gradient(135deg,#004080,#0066cc); color:white; text-align:center; padding:80px 20px; border-radius:10px; margin:20px; box-shadow:0 8px 20px rgba(0,0,0,0.2);}
        .hero h1 { font-size:3em; margin-bottom:15px; }
        .hero p { font-size:1.3em; margin-bottom:20px; }
        .btn-primary { background:#ff6600; color:white; padding:12px 25px; border:none; border-radius:6px; cursor:pointer; font-size:1em; transition:0.3s; }
        .btn-primary:hover { background:#e65c00; }

        /* Main content */
        .container { max-width:1200px; margin:auto; padding:20px; }
        .section-title { font-size:2em; text-align:center; margin-bottom:40px; }

        /* Room cards */
        .room-grid { display:flex; flex-wrap:wrap; gap:20px; justify-content:center; }
        .room-card { background:white; border-radius:10px; padding:20px; width:300px; box-shadow:0 6px 15px rgba(0,0,0,0.1); text-align:center; transition:0.3s; }
        .room-card:hover { box-shadow:0 10px 25px rgba(0,0,0,0.2); }
        .room-card h3 { font-size:1.5em; margin-bottom:10px; }
        .room-card p { margin-bottom:15px; font-size:1.1em; }

        /* Footer */
        footer { background:#222; color:white; text-align:center; padding:20px; margin-top:40px; }
        
        /* Responsive */
        @media (max-width:768px){
            .hero h1 { font-size:2.2em; }
            .hero p { font-size:1em; }
            .room-card { width:90%; }
            .navbar { flex-direction:column; align-items:flex-start; }
            .navbar a { margin:5px 0 0 0; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo"><a href="{{ route('home') }}">Hotel Booking</a></div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <a href="{{ route('booking.create') }}">Book a Room</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Hotel Booking System. All rights reserved.
    </footer>

</body>
</html>
