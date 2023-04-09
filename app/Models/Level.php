<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'name'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
