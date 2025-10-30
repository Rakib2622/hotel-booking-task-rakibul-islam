@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Bookings</h1>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">Name</th>
            <th class="border px-2 py-1">Email</th>
            <th class="border px-2 py-1">Category</th>
            <th class="border px-2 py-1">From</th>
            <th class="border px-2 py-1">To</th>
            <th class="border px-2 py-1">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $b)
        <tr>
            <td class="border px-2 py-1">{{ $b->id }}</td>
            <td class="border px-2 py-1">{{ $b->name }}</td>
            <td class="border px-2 py-1">{{ $b->email }}</td>
            <td class="border px-2 py-1">{{ $b->category->name }}</td>
            <td class="border px-2 py-1">{{ $b->from_date }}</td>
            <td class="border px-2 py-1">{{ $b->to_date }}</td>
            <td class="border px-2 py-1">
                <a href="{{ route('admin.bookings.show', $b->id) }}" class="text-blue-600">View</a> |
                <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?');" class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $bookings->links() }}
@endsection
