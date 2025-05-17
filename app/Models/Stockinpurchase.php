<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockinpurchase extends Model
{
    protected $fillable = ['item_id', 'supplier_id', 'purchase_date', 'quantity', 'total_cost'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}