<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $guarded = [];

    public function expenceType()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }


    public function movements()
    {
        return $this->morphMany(Movement::class,'movementable');
    }


    
}
