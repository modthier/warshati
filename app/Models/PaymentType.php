<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function paymentMethod()
    {
        return $this->belongsToMany(PaymentMethod::class,'method_types','payment_type_id','method_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function pointInvoice()
    {
        return $this->hasMany(PointInvoice::class);
    }
}
