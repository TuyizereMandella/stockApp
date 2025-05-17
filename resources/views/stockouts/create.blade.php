@extends('layouts.app')
@section('content')
    <h1>Record Stock-out</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    <form method="POST" action="/stockouts">
        @csrf
        <div class="form-group">
            <label>Item</label>
            <select name="item_id" required>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Stock-out Date</label>
            <input type="date" name="stockout_date" required>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" required>
        </div>
        <div class="form-group">
            <label>Total Price</label>
            <input type="number" name="total_price" step="0.01" required>
        </div>
        <button type="submit" class="btn">Record Stock-out</button>
    </form>
@endsection