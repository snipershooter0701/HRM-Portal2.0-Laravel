<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'department_id',
        'permission',
        'access_view',
        'access_add',
        'access_edit',
        'access_delete',
        'access_permission'
    ];

    /**
     * Get role's department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the permissions of role.
     */
    public function permissions()
    {
        return $this->hasMany(RoleModule::class);
    }
}