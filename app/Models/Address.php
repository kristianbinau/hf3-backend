<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'road',
        'road_num',
        'apartment_floor',
        'apartment_num',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
