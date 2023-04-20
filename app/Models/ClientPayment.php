<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'client_id',
        'payment_received_date',
        'amount_due',
        'amount_received',
        'bank_id',
        'pay_method_id',
        'comments',
        'attachment'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientConfidential()
    {
        return $this->belongsTo(ClientConfidential::class);
    }
}