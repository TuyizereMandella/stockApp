@extends('layouts.app')
@section('content')
    <h1>Stock-out Details</h1>
    <p><strong>Item:</strong> {{ $stockout->item->name }}</p>
    <p><strong>Stock-out Date:</strong> {{ $stockout->stockout_date }}</p>
    <p><strong>Quantity:</strong> {{ $stockout->quantity }}</p>
    <p><strong>Total Price:</strong> {{ number_format($stockout->total_price, 2) }}</p>
    <a href="/stockouts" class="btn">Back</a>
@endsection