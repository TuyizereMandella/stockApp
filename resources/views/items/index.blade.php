@extends('layouts.app')
@section('content')
    <h1>Items</h1>
    <a href="/items/create" class="btn">Add Item</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Actions</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>
                    <a href="/items/{{ $item->id }}" class="btn">View</a>
                    <a href="/items/{{ $item->id }}/edit" class="btn">Edit</a>
                    <form action="/items/{{ $item->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection