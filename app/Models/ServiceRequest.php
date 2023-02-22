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
            ->withPivot('price')
            ->withTimestamps();
    }


    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }


    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }


    public function car()
    {
        return $this->belongsTo(CarSize::class,'car_size_id');
    }

    
}
