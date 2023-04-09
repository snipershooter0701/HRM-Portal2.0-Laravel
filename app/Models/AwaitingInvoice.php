<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwaitingInvoice extends Model
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
        'invoice_frequency',
        'invoice_from',
        'invoice_to',
        'total_hours'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Get the employee information
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the client information
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}