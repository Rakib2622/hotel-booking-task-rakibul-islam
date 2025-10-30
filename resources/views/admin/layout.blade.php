<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<style>
    /* Basic Reset */
    * { box-sizing: border-box; margin:0; padding:0; font-family: Arial, sans-serif; }
    body { background: #f4f4f4; }

    /* Layout */
    .container { display: flex; min-height: 100vh; }
    .sidebar {
        width: 240px;
        background: #2c3e50;
        color: #fff;
        flex-shrink: 0;
        transition: transform 0.3s ease;
        padding-top: 20px;
        position: fixed;
        height: 100%;
    }
    .sidebar.hidden { transform: translateX(-100%); }
    .sidebar a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 12px 20px;
        transition: background 0.2s;
    }
    .sidebar a:hover { background: #34495e; }

    .main { flex: 1; margin-left: 240px; padding: 20px; transition: margin-left 0.3s ease; }
    .main.full { margin-left: 0; }

    header { background: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
    .hamburger { display: none; cursor: pointer; }
    .hamburger div { width: 25px; height: 3px; background: #333; margin: 5px 0; }

    /* Tables */
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background: #eee; }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar { position: fixed; z-index: 10; top: 0; left: 0; height: 100%; }
        .main { margin-left: 0; }
        .hamburger { display: block; }
    }
</style>
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <h2 style="text-align:center; margin-bottom:20px;">Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.room-categories.index') }}">Room Categories</a>
        <a href="{{ route('admin.rooms.index') }}">Rooms</a>
        <a href="{{ route('admin.bookings.index') }}">Bookings</a>
    </nav>

    <!-- Main content -->
    <div class="main" id="mainContent">
        <header>
            <div class="hamburger" onclick="toggleSidebar()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <!-- <h1>Admin Panel</h1> -->
            <a href="{{ route('home') }}" style="text-decoration:none; color:#3498db;">View home page</a>
        </header>

        @yield('content')
    </div>
</div>

<script>
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var main = document.getElementById('mainContent');
    sidebar.classList.toggle('hidden');
    main.classList.toggle('full');
}
</script>

</body>
</html>
