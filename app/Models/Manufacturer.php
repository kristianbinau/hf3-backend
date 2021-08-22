<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function delete()
    {
        foreach($this->products()->get() as $product) {
            $product->delete();
        }

        return parent::delete();
    }
}
