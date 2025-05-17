@extends('layouts.app')
@section('content')
    <h1>Edit Stock-out</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    <form method="POST" action="/stockouts/{{ $stockout->id }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Item</label>
            <select name="item_id" required>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $stockout->item_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Stock-out Date</label>
            <input type="date" name="stockout_date" value="{{ $stockout->stockout_date }}" required>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ $stockout->quantity }}" required>
        </div>
        <div class="form-group">
            <label>Total Price</label>
            <input type="number" name="total_price" value="{{ $stockout->total_price }}" step="0.01" required>
        </div>
        <button type="submit" class="btn">Update Stock-out</button>
    </form>
@endsection