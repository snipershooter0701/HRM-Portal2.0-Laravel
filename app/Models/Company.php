<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'email',
        'address',
        'phone',
        'favicon',
        'logo',
        'currency_id',
        'timezone_id',
        'alignment',
        'footer_text'
    ];

    /**
     * Get the currency information.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the timezone information
     */
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }
}
