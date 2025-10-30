@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Room Category</h1>

@if ($errors->any())
    <div class="bg-red-100 p-4 mb-4 rounded">
        <ul class="list-disc pl-5 text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.room-categories.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf

    <div class="mb-4">
        <label class="block font-semibold mb-1">Category Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Base Price (BDT)</label>
        <input type="number" name="base_price" value="{{ old('base_price') }}" class="w-full p-2 border rounded">
    </div>

    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Save</button>
    <a href="{{ route('admin.room-categories.index') }}" class="ml-2 text-gray-600">Cancel</a>
</form>
@endsection
