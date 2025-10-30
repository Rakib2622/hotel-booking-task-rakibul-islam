@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Room Categories</h1>

<a href="{{ route('admin.room-categories.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">Add New Category</a>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">Name</th>
            <th class="border px-2 py-1">Base Price</th>
            <th class="border px-2 py-1">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td class="border px-2 py-1">{{ $cat->id }}</td>
            <td class="border px-2 py-1">{{ $cat->name }}</td>
            <td class="border px-2 py-1">{{ number_format($cat->base_price) }} BDT</td>
            <td class="border px-2 py-1">
                <a href="{{ route('admin.room-categories.edit', $cat->id) }}" class="text-blue-600">Edit</a> |
                <form action="{{ route('admin.room-categories.destroy', $cat->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?');" class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
