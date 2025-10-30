@extends('admin.layout')

@section('content')
<h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">Add New Room Category</h1>

@if ($errors->any())
    <div style="background:#fde2e2; color:#b71c1c; padding:15px; margin-bottom:20px; border-radius:10px;">
        <ul style="padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.room-categories.store') }}" method="POST" 
      style="background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.1); max-width:500px; margin:auto;">
    @csrf

    <div style="margin-bottom:20px;">
        <label style="display:block; font-weight:bold; margin-bottom:5px;">Category Name</label>
        <input type="text" name="name" value="{{ old('name') }}" 
               style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
    </div>

    <div style="margin-bottom:20px;">
        <label style="display:block; font-weight:bold; margin-bottom:5px;">Base Price (BDT)</label>
        <input type="number" name="base_price" value="{{ old('base_price') }}" 
               style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
    </div>

    <div style="display:flex; align-items:center; gap:10px;">
        <button type="submit" 
                style="background:#2980b9; color:#fff; padding:10px 20px; border-radius:8px; border:none; cursor:pointer; transition:0.3s;"
                onmouseover="this.style.background='#2471a3';" onmouseout="this.style.background='#2980b9';">
            Save
        </button>
        <a href="{{ route('admin.room-categories.index') }}" 
           style="color:#7f8c8d; text-decoration:none; font-weight:bold;">Cancel</a>
    </div>
</form>
@endsection
