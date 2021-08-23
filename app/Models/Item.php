<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'product_id',
        'discount_price',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }

    public function delete()
    {
        foreach($this->orderItem()->get() as $orderItem) {
            $orderItem->delete();
        }

        return parent::delete();
    }
}
