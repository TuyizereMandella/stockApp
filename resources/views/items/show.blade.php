@extends('layouts.app')
@section('content')
    <h1>{{ $item->name }}</h1>
    <p><strong>Description:</strong> {{ $item->description ?? 'None' }}</p>
    <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
    <p><strong>Unit Price:</strong> {{ number_format($item->unit_price, 2) }}</p>
    <a href="/items" class="btn">Back</a>
@endsection