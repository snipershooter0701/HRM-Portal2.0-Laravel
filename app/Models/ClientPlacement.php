<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPlacement extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'employee_id',
        'job_tire_id',
        'net_terms',
        'po_attachment',
        'po_id',
        'client_bill_rate',
        'client_ot_bill_rate',
        'client_dt_bill_rate',
        'client_vendor_id',
        'vendor_contractor_id',
        'vendor_contractor_netterms',
        'vendor_contractor_po_attachment',
        'vendor_contractor_po_id',
        'vendor_contractor_bill_rate',
        'vendor_contractor_at_bill_rate',
        'vendor_contractor_dt_bill_rate',
        'job_title',
        'job_status',
        'job_start_date',
        'job_end_date',
        'invoice_frequency',
        'pay_effect_date'
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
     * Get the employee information
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the jobtire information
     */
    public function jobTire()
    {
        return $this->belongsTo(JobTire::class);
    }
}