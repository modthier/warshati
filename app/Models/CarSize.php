<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSize extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function serviceType()
    {
        return $this->belongsToMany(ServiceType::class,'ratios','car_size_id','service_type_id')
            ->withPivot(['ratio'])
            ->withTimestamps();
    }
}
