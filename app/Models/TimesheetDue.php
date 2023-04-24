<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimesheetDue extends Model
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
        'placement_id',
        'job_tire_id',
        'date_from',
        'date_to'
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

    /**
     * Get the jobtire information.
     */
    public function jobtire()
    {
        return $this->belongsTo(JobTire::class, 'job_tire_id');
    }

    /**
     * Get the placement information.
     */
    public function placement()
    {
        return $this->belongsTo(ClientPlacement::class, 'placement_id');
    }
}