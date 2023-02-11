<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsToMany(Purchase::class,'purchase_items','stock_id','purchase_id');   
    }

    public function product()
    {
       return $this->belongsTo(Product::class);
    }

    public static function checkStock($quantitys)
    {
        $errors = "";
        foreach ($quantitys as $id => $quantity) {
            $stock = Stock::find($id);
            if($quantity['quantity'] > $stock->quantity){
                $errors .= "الكمية المطلوبة من ({$stock->product->name}) اكبر من المتوفر";
                $errors .= "--------------------------------";
            }
        }

        return $errors;
    }  

    
    public function order()
    {
        return $this->belongsToMany(Order::class,'order_details','stock_id','order_id')
            ->withTimestamps();
    }
}
