@extends('admin.layout')

@section('content')
<h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">Admin Dashboard</h1>

<!-- Stats Cards -->
<div style="display:flex; flex-wrap:wrap; gap:20px; margin-bottom:30px;">
    <div style="flex:1; min-width:200px; background: linear-gradient(135deg, #3498db, #2980b9); color:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="font-weight:bold; font-size:16px;">Total Bookings</h2>
        <p style="font-size:24px; margin-top:10px;">{{ $totalBookings }}</p>
    </div>
    <div style="flex:1; min-width:200px; background: linear-gradient(135deg, #2ecc71, #27ae60); color:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="font-weight:bold; font-size:16px;">Total Rooms</h2>
        <p style="font-size:24px; margin-top:10px;">{{ $totalRooms }}</p>
    </div>
    <div style="flex:1; min-width:200px; background: linear-gradient(135deg, #e67e22, #d35400); color:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="font-weight:bold; font-size:16px;">Total Categories</h2>
        <p style="font-size:24px; margin-top:10px;">{{ $totalCategories }}</p>
    </div>
</div>

<!-- Recent Bookings -->
<h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">Recent Bookings</h2>
<div style="overflow-x:auto; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#ecf0f1;">
                <th style="padding:10px; text-align:left;">ID</th>
                <th style="padding:10px; text-align:left;">Name</th>
                <th style="padding:10px; text-align:left;">Category</th>
                <th style="padding:10px; text-align:left;">From</th>
                <th style="padding:10px; text-align:left;">To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentBookings as $b)
            <tr style="border-bottom:1px solid #ddd; transition: background 0.2s;" onmouseover="this.style.background='#f1f1f1';" onmouseout="this.style.background='transparent';">
                <td style="padding:10px;">{{ $b->id }}</td>
                <td style="padding:10px;">{{ $b->name }}</td>
                <td style="padding:10px;">{{ $b->category->name }}</td>
                <td style="padding:10px;">{{ $b->from_date }}</td>
                <td style="padding:10px;">{{ $b->to_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
