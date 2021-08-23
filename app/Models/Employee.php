<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'address_id',
        'login_id',
        'name',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function login()
    {
        return $this->belongsTo(Login::class);
    }

    public function delete()
    {
        $parent = parent::delete();

        foreach($this->login()->get() as $login) {
            $login->delete();
        }

        return $parent;
    }
}
