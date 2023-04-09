<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'level_id',
        'updated_by',
        'description'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
