<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DueInvoiceActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'due_invoice_id',
        'updated_by',
        'description'
    ];

    public function dueInvoice()
    {
        return $this->belongsTo(DueInvoice::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
