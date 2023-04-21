<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'country_code',
        'state_code',
        'state_name'
    ];

    /**
     * Get the country information.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }
}
