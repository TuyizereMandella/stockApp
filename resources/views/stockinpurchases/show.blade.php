@extends('layouts.app')
@section('content')
    <h1>Stock-in Details</h1>
    <p><strong>Item:</strong> {{ $stockinpurchase->item->name }}</p>
    <p><strong>Supplier:</strong> {{ $stockinpurchase->supplier->name }}</p>
    <p><strong>Purchase Date:</strong> {{ $stockinpurchase->purchase_date }}</p>
    <p><strong>Quantity:</strong> {{ $stockinpurchase->quantity }}</p>
    <p><strong>Total Cost:</strong> {{ number_format($stockinpurchase->total_cost, 2) }}</p>
    <a href="/stockinpurchases" class="btn">Back</a>
@endsection