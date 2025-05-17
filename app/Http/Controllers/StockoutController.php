<?php
namespace App\Http\Controllers;

use App\Models\Stockout;
use App\Models\Item;
use Illuminate\Http\Request;

class StockoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        $stockouts = Stockout::with('item')->get();
        return view('stockouts.index', compact('stockouts'));
    }

    public function create()
    {
        $items = Item::all();
        return view('stockouts.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'stockout_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $item = Item::find($request->item_id);
        if ($item->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock']);
        }
        $item->update(['quantity' => $item->quantity - $request->quantity]);

        Stockout::create($request->all());
        return redirect('/stockouts')->with('success', 'Stock-out recorded!');
    }

    public function show(Stockout $stockout)
    {
        return view('stockouts.show', compact('stockout'));
    }

    public function edit(Stockout $stockout)
    {
        $items = Item::all();
        return view('stockouts.edit', compact('stockout', 'items'));
    }

    public function update(Request $request, Stockout $stockout)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'stockout_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $oldItem = Item::find($stockout->item_id);
        $newItem = Item::find($request->item_id);
        $quantityDiff = $request->quantity - $stockout->quantity;
        if ($newItem->quantity + $quantityDiff < 0) {
            return back()->withErrors(['quantity' => 'Insufficient stock']);
        }
        $newItem->update(['quantity' => $newItem->quantity + $quantityDiff]);
        $oldItem->update(['quantity' => $oldItem->quantity - $quantityDiff]);

        $stockout->update($request->all());
        return redirect('/stockouts')->with('success', 'Stock-out updated!');
    }

    public function destroy(Stockout $stockout)
    {
        $item = Item::find($stockout->item_id);
        $item->update(['quantity' => $item->quantity + $stockout->quantity]);
        $stockout->delete();
        return redirect('/stockouts')->with('success', 'Stock-out deleted!');
    }
}