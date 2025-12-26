<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'shipping_address',
        'notes',
        'payment_status',
        'shipping_status',
        'total_amount',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
