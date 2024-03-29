<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'order_confirmation',
        'promotions_and_updates',
        'profile_picture_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the customer record associated with the user.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    // Accessor method to check if the user should receive order confirmation emails
    public function shouldSendOrderConfirmation()
    {
        return $this->order_confirmation;
    }

    // Accessor method to check if the user has opted for promotions and updates
    public function shouldReceivePromotionsAndUpdates()
    {
        return $this->promotions_and_updates;
    }
}
