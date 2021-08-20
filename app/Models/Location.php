<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Item::class);
    }
}
