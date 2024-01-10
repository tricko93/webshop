<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone_number',
        'mobile_number',
        'street_name',
        'street_number',
        'postal_code',
        'city',
        'floor',
        'apartment_number',
        'additional_info'
    ];

    /**
     * Get the user that owns the customer record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
