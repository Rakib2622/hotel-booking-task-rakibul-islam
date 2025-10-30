@extends('admin.layout')

@section('content')
<h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">Room Categories</h1>

<div style="margin-bottom:20px;">
    <a href="{{ route('admin.room-categories.create') }}" 
       style="background:#2980b9; color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none; transition:0.3s;"
       onmouseover="this.style.background='#2471a3';" onmouseout="this.style.background='#2980b9';">
       Add New Category
    </a>
</div>

<div style="overflow-x:auto; background:#fff; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.05); padding:15px;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background: linear-gradient(90deg, #3498db, #2980b9); color:#fff;">
                <th style="padding:12px; text-align:left;">ID</th>
                <th style="padding:12px; text-align:left;">Name</th>
                <th style="padding:12px; text-align:left;">Base Price</th>
                <th style="padding:12px; text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr style="border-bottom:1px solid #ddd; transition: background 0.2s;" 
                onmouseover="this.style.background='#f9f9f9';" onmouseout="this.style.background='transparent';">
                <td style="padding:10px;">{{ $cat->id }}</td>
                <td style="padding:10px;">{{ $cat->name }}</td>
                <td style="padding:10px;">{{ number_format($cat->base_price) }} BDT</td>
                <td style="padding:10px;">
                    <a href="{{ route('admin.room-categories.edit', $cat->id) }}" 
                       style="color:#27ae60; text-decoration:none; margin-right:10px;">Edit</a>
                    <form action="{{ route('admin.room-categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
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
</div>
@endsection
