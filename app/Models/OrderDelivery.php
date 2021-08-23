<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'address_id',
        'order_delivery_type_id',
        'carrier',
        'tracking_id',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function type()
    {
        return $this->belongsTo(OrderDeliveryType::class);
    }
}
