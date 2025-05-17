<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function stockinpurchases()
    {
        return $this->hasMany(Stockinpurchase::class);
    }
}