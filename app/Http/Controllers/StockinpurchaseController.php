<?php
namespace App\Http\Controllers;

use App\Models\Stockinpurchase;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockinpurchaseController extends Controller
{
    /**
     * Apply the auth.admin middleware to ensure only authenticated admins can access
     * the controller methods
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the stock-in purchases
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stockinpurchases = Stockinpurchase::with(['item', 'supplier'])->get(); // Eager load item and supplier relationships
        return view('stockinpurchases.index', compact('stockinpurchases')); // Pass data to the index view
    }

    /**
     * Show the form for creating a new stock-in purchase
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all(); // Fetch all items for the dropdown in the form
        return view('stockinpurchases.create', compact('items')); // Pass items to the create view
    }

    /**
     * Store a newly created stock-in purchase in the database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'item_id' => 'required|exists:items,id', // Must exist in items table
            'supplier_name' => 'required|string|max:255', // Validate supplier name input
            'purchase_date' => 'required|date', // Must be a valid date
            'quantity' => 'required|integer|min:1', // Must be a positive integer
            'total_cost' => 'required|numeric|min:0', // Must be a non-negative number
        ]);

        // Find or create a supplier based on the entered name
        $supplier = Supplier::firstOrCreate(
            ['name' => $request->supplier_name], // Search or create by name
            ['email' => '', 'phone' => ''] // Default values for required fields if new
        );

        // Update the quantity of the associated item
        $item = Item::find($request->item_id);
        $item->update(['quantity' => $item->quantity + $request->quantity]);

        // Create a new stock-in purchase record
        Stockinpurchase::create([
            'item_id' => $request->item_id,
            'supplier_id' => $supplier->id, // Link to the found or created supplier
            'purchase_date' => $request->purchase_date,
            'quantity' => $request->quantity,
            'total_cost' => $request->total_cost,
        ]);

        return redirect('/stockinpurchases')->with('success', 'Stock-in recorded!'); // Redirect with success message
    }

    /**
     * Display the specified stock-in purchase
     *
     * @param \App\Models\Stockinpurchase $stockinpurchase
     * @return \Illuminate\View\View
     */
    public function show(Stockinpurchase $stockinpurchase)
    {
        return view('stockinpurchases.show', compact('stockinpurchase')); // Pass the stock-in to the show view
    }

    /**
     * Show the form for editing the specified stock-in purchase
     *
     * @param \App\Models\Stockinpurchase $stockinpurchase
     * @return \Illuminate\View\View
    */
    public function edit(Stockinpurchase $stockinpurchase)
    {
        $items = Item::all(); // Fetch all items for the dropdown
        return view('stockinpurchases.edit', compact('stockinpurchase', 'items')); // Pass data to the edit view
    }

    /**
     * Update the specified stock-in purchase in the database
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stockinpurchase $stockinpurchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Stockinpurchase $stockinpurchase)
    {
        // Validate the incoming request data
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'supplier_name' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'total_cost' => 'required|numeric|min:0',
        ]);

        // Find or create a supplier based on the entered name
        $supplier = Supplier::firstOrCreate(
            ['name' => $request->supplier_name],
            ['email' => '', 'phone' => '']
        );

        // Update item quantities based on the difference
        $oldItem = Item::find($stockinpurchase->item_id);
        $newItem = Item::find($request->item_id);
        $quantityDiff = $request->quantity - $stockinpurchase->quantity;
        $newItem->update(['quantity' => $newItem->quantity + $quantityDiff]);
        $oldItem->update(['quantity' => $oldItem->quantity - $quantityDiff]);

        // Update the stock-in purchase record
        $stockinpurchase->update([
            'item_id' => $request->item_id,
            'supplier_id' => $supplier->id, // Update with new or existing supplier ID
            'purchase_date' => $request->purchase_date,
            'quantity' => $request->quantity,
            'total_cost' => $request->total_cost,
        ]);

        return redirect('/stockinpurchases')->with('success', 'Stock-in updated!'); // Redirect with success message
    }

    /**
     * Remove the specified stock-in purchase from the database
     *
     * @param \App\Models\Stockinpurchase $stockinpurchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Stockinpurchase $stockinpurchase)
    {
        $item = Item::find($stockinpurchase->item_id);
        $item->update(['quantity' => $item->quantity - $stockinpurchase->quantity]); // Decrease item quantity
        $stockinpurchase->delete(); // Delete the stock-in record
        return redirect('/stockinpurchases')->with('success', 'Stock-in deleted!'); // Redirect with success message
    }
}