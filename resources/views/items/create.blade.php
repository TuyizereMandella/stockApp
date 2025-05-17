@extends('layouts.app')
@section('content')
    <h1>Add Item</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    <form method="POST" action="/items">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" required>
        </div>
        <div class="form-group">
            <label>Unit Price</label>
            <input type="number" name="unit_price" step="0.01" required>
        </div>
        <button type="submit" class="btn">Add Item</button>
    </form>
@endsection