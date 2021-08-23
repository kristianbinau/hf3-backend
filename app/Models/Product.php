<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'manufacturer_id',
        'name',
        'description',
        'price',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function delete()
    {
        foreach($this->items()->get() as $item) {
            $item->delete();
        }

        return parent::delete();
    }
}
