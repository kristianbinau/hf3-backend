<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

    public function delete()
    {
        foreach($this->employees()->get() as $employee) {
            $employee->delete();
        }

        return parent::delete();
    }
}
