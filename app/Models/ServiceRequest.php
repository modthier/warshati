<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service()
    {
        return $this->belongsToMany(Service::class,'service_request_details','service_request_id','service_id')
            ->withTimestamps();
    }
}
