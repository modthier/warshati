<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function serviceRequest()
    {
        return $this->belongsToMany(ServiceRequest::class,'service_request_details','service_id','service_request_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
