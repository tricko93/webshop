<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static array $statuses = [
        'pending',
        'processing',
        'shipped',
        'completed',
        'cancelled'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
