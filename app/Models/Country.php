<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'name'];

    /**
     * Summary of employees
     *
     *Relationship-> country has many employees
     */
    public function employees(){
        return $this->hasMany(Employee::class);
    }

    /**
     * Relationship -> country has many states
     */
    public function states(){
        return $this->hasMany(State::class);
    }
}
