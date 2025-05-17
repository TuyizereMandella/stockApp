<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockout extends Model
{
    protected $fillable = ['item_id', 'stockout_date', 'quantity', 'total_price'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}