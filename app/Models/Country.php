<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name'
    ];

    /**
     * Get the country's states.
     */
    public function states()
    {
        return $this->hasMany(State::class, 'country_code', 'code');
    }
}
