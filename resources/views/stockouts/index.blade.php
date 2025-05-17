@extends('layouts.app')
@section('content')
    <h1>Stock-outs</h1>
    <a href="/stockouts/create" class="btn">Record Stock-out</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Actions</th>
        </tr>
        @foreach ($stockouts as $stockout)
            <tr>
                <td>{{ $stockout->id }}</td>
                <td>{{ $stockout->item->name }}</td>
                <td>{{ $stockout->quantity }}</td>
                <td>{{ number_format($stockout->total_price, 2) }}</td>
                <td>
                    <a href="/stockouts/{{ $stockout->id }}" class="btn">View</a>
                    <a href="/stockouts/{{ $stockout->id }}/edit" class="btn">Edit</a>
                    <form action="/stockouts/{{ $stockout->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection