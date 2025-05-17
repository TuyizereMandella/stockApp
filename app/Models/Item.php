<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $fillable = ['name', 'description', 'quantity', 'unit_price'];

    public function stockinpurchases()
    {
        return $this->hasMany(Stockinpurchase::class);
    }

    public function stockouts()
    {
        return $this->hasMany(Stockout::class);
    }
}
