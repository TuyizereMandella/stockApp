@extends('layouts.app')
@section('content')
    <h1>Edit Stock-in</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    <form method="POST" action="/stockinpurchases/{{ $stockinpurchase->id }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Item</label>
            <select name="item_id" required>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $stockinpurchase->item_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Supplier</label>
            <input type="text" name="supplier_name" value="{{ $stockinpurchase->supplier->name ?? '' }}" required> <!-- Pre-fill with existing supplier name -->
        </div>
        <div class="form-group">
            <label>Purchase Date</label>
            <input type="date" name="purchase_date" value="{{ $stockinpurchase->purchase_date }}" required>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ $stockinpurchase->quantity }}" required>
        </div>
        <div class="form-group">
            <label>Total Cost</label>
            <input type="number" name="total_cost" value="{{ $stockinpurchase->total_cost }}" step="0.01" required>
        </div>
        <button type="submit" class="btn">Update Stock-in</button>
    </form>
@endsection