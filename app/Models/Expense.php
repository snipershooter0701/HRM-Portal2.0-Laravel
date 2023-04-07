<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'category',
        'type',
        'employee_id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function expensebill() {
        return $this->hasMany(ExpenseBill::class);
    }
}
