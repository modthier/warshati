<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function paymentType()
    {
        return $this->belongsToMany(PaymentType::class,'method_types','method_id','payment_type_id','id','id');
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
