@extends('admin.layout')

@section('content')
<h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">Bookings</h1>

<div style="overflow-x:auto; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05); padding:20px;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#ecf0f1;">
                <th style="padding:12px; text-align:left;">ID</th>
                <th style="padding:12px; text-align:left;">Name</th>
                <th style="padding:12px; text-align:left;">Email</th>
                <th style="padding:12px; text-align:left;">Category</th>
                <th style="padding:12px; text-align:left;">From</th>
                <th style="padding:12px; text-align:left;">To</th>
                <th style="padding:12px; text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr style="border-bottom:1px solid #ddd; transition: background 0.2s;" 
                onmouseover="this.style.background='#f9f9f9';" onmouseout="this.style.background='transparent';">
                <td style="padding:10px;">{{ $b->id }}</td>
                <td style="padding:10px;">{{ $b->name }}</td>
                <td style="padding:10px;">{{ $b->email }}</td>
                <td style="padding:10px;">{{ $b->category->name }}</td>
                <td style="padding:10px;">{{ $b->from_date }}</td>
                <td style="padding:10px;">{{ $b->to_date }}</td>
                <td style="padding:10px;">
                    <a href="{{ route('admin.bookings.show', $b->id) }}" 
                       style="color:#3498db; text-decoration:none; margin-right:10px;">View</a>
                    <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?');" 
                                style="color:#e74c3c; background:none; border:none; cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="margin-top:15px; text-align:right;">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
