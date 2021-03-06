<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'extra_info',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->hasOne(OrderDelivery::class);
    }

    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function delete()
    {
        foreach($this->items()->get() as $orderItems) {
            $orderItems->delete();
        }

        foreach($this->discounts()->get() as $discount) {
            $discount->delete();
        }

        foreach($this->delivery()->get() as $delivery) {
            $delivery->delete();
        }

        return parent::delete();
    }
}
