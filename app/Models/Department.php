<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

     /**
     * Summary of employees
     *
     *Relationship-> Department has many employees
     */
    public function employees(){
        return $this->hasMany(Employee::class);
    }

}
