<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsToMany(Stock::class,'order_details','order_id','stock_id')
            ->withPivot(['quantity','selling_price','purchase_price'])
            ->withTimestamps();
    }

    public function service_request()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
