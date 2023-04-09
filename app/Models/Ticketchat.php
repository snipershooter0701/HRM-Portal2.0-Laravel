<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketchat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ticket_id',
        'sender_id',
        'receiver_id',
        'text',
    ];
}
