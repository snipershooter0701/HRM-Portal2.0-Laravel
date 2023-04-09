<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'updated_by',
        'description'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}