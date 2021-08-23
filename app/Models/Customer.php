<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'login_id',
        'address_id',
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function login()
    {
        return $this->belongsTo(Login::class);
    }

    public function delete()
    {
        foreach($this->orders()->get() as $order) {
            $order->delete();
        }

        $parent = parent::delete();

        foreach($this->login()->get() as $login) {
            $login->delete();
        }

        return $parent;
    }
}
