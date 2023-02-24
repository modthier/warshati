<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerRatio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }


    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
