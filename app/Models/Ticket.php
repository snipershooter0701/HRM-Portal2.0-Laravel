<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'subject',
        'attachment',
        'details',
        'created_on',
        'closed_on',
        'assigned_id',
        'status',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function assigned() {
        return $this->belongsTo(Employee::class, 'assigned_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'assigned_id');
    }
}
