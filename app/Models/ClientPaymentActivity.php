<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPaymentActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_payment_id',
        'updated_by',
        'description'
    ];

    public function clientPayment()
    {
        return $this->belongsTo(ClientPayment::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
