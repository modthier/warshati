<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stock()
    {
       return $this->hasMany(Stock::class);
    }

    public function purchase()
    {
        return $this->belongsToMany(Purchase::class,'purchase_items','product_id','purchase_id');   
    }
}
