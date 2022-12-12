<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;


    protected $fillable = ['country_id', 'name'];

    /**
     * Summary of employees
     *
     *Relationship-> State has many employees
     */
    public function employees(){
        return $this->hasMany(Employee::class);
    }

    /**
     * Relationship ->state belongsTo country
     */
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
