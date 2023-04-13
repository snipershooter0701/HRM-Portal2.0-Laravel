<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'employee_id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
