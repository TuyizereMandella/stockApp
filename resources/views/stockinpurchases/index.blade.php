@extends('layouts.app')
@section('content')
    <h1>Stock-ins</h1>
    <a href="/stockinpurchases/create" class="btn">Record Stock-in</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Actions</th>
        </tr>
        @foreach ($stockinpurchases as $stockinpurchase)
            <tr>
                <td>{{ $stockinpurchase->id }}</td>
                <td>{{ $stockinpurchase->item->name }}</td>
                <td>{{ $stockinpurchase->supplier->name }}</td>
                <td>{{ $stockinpurchase->quantity }}</td>
                <td>{{ number_format($stockinpurchase->total_cost, 2) }}</td>
                <td>
                    <a href="/stockinpurchases/{{ $stockinpurchase->id }}" class="btn">View</a>
                    <a href="/stockinpurchases/{{ $stockinpurchase->id }}/edit" class="btn">Edit</a>
                    <form action="/stockinpurchases/{{ $stockinpurchase->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection