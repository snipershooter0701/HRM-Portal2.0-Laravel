<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'folder_id',
        'receiver_id',
        'share_id',
    ];

    public function folder() {
        return $this->belongsTo(Folder::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'receiver_id');
    }
}
