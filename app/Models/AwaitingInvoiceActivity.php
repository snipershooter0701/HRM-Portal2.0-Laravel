<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwaitingInvoiceActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'awaiting_invoice_id',
        'updated_by',
        'description'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
