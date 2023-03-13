<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function carSize()
    {
        return $this->belongsToMany(CarSize::class,'ratios','service_type_id','car_size_id')
            ->withPivot(['ratio'])
            ->withTimestamps();
    }
}
