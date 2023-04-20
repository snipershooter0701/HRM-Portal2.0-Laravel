<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DueInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'client_id',
        'invoice_date',
        'invoice_due_date',
        'invoiced_amount',
        'received_amount',
        'invoice_frequency',
        'net_terms',
        'include_po_attach',
        'invoice_recipient',
        'invoice_cc_emails',
        'invoice_bcc_emails',
        'notes',
        'statement_memo',
        'attachment',
        'payable_to',
        'additional_info',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Get the client information
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get employee information
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
