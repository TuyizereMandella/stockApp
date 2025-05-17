@extends('layouts.app')
@section('content')
    <h1>Record Stock-in</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    <form method="POST" action="/stockinpurchases">
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
            <label>Supplier</label>
            <input type="text" name="supplier_name" required> 
        </div>
        <div class="form-group">
            <label>Purchase Date</label>
            <input type="date" name="purchase_date" required>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" required>
        </div>
        <div class="form-group">
            <label>Total Cost</label>
            <input type="number" name="total_cost" step="0.01" required>
        </div>
        <button type="submit" class="btn">Record Stock-in</button>
    </form>
@endsection