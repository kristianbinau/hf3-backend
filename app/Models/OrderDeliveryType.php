<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryType extends Model
{
    use HasFactory;

    public function orderDeliveries()
    {
        return $this->hasMany(OrderDelivery::class);
    }
}
