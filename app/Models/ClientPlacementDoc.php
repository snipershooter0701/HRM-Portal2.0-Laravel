<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPlacementDoc extends Model
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
        'job_tire_id',
        'client_placement_id',
        'client_placement_doctype_id',
        'title',
        'comment',
        'expire_date',
        'attachment',
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
     * Get the jobtire information
     */
    public function jobtire()
    {
        return $this->belongsTo(JobTire::class);
    }

    /**
     * Get the placement information
     */
    public function placement()
    {
        return $this->belongsTo(ClientPlacement::class);
    }

    /**
     * Get the placement doctype information
     */
    public function doctype()
    {
        return $this->belongsTo(ClientPlacementDoctype::class, 'client_placement_doctype_id');
    }
}
