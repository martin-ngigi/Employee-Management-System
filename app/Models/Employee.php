<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city_id',
        'city_id',
        'country_id',
        'department_id',
        'zip_code',
        'birth_date',
        'date_hired',
    ];

    function country(){
        return $this->belongsTo(Country::class);
    }

    function state(){
        return $this->belongsTo(State::class);
    }

    function city(){
        return $this->belongsTo(City::class);
    }

    function department(){
        return $this->belongsTo(Department::class);
    }
}
