<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'role_id'
    ];

    /**
     * Get role information
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
