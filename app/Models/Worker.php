<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function ratio()
    {
        return $this->hasMany(WorkerRatio::class,'worker_id');
    }


}
