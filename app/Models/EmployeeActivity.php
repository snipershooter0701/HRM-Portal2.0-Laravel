<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'employee_id',
        'updated_by',
        'description'
    ];

    
    public function updatedby()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
