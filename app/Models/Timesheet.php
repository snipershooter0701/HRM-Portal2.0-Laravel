<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'employee_id',
        'client_id',
        'job_tire_id',
        'placement_id',
        'date_from',
        'date_to',
        'job_tire_id',
        'attachment',
        'report',
        'reason',
        'status',
        'submitted_on',
        'standard_time',
        'standard_mon',
        'standard_tue',
        'standard_wed',
        'standard_thu',
        'standard_fri',
        'standard_sat',
        'standard_sun',
        'over_time',
        'over_mon',
        'over_tue',
        'over_wed',
        'over_thu',
        'over_fri',
        'over_sat',
        'over_sun',
        'double_time',
        'double_mon',
        'double_tue',
        'double_wed',
        'double_thu',
        'double_fri',
        'double_sat',
        'double_sun',
        'total_billable_hours'
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
