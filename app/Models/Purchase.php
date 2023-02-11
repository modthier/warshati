<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsToMany(Stock::class,'purchase_items','purchase_id','stock_id')
            ->withPivot(['quantity','quantity_per_unit','subtotal','stock_id'])
            ->withTimestamps();
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'purchase_items','product_id','purchase_id');   
    }
}
