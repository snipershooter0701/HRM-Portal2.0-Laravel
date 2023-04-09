<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientConfidential extends Model
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
        'bankname',
        'accounttype',
        'accountnumber',
        'routingnumber',
        'country_id',
        'state_id',
        'city',
        'suite_aptno',
        'street',
        'zipcode',
        'cancelled_check',
        'other_attachment',
        'status',
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
}