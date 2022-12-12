<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'name'];

    /**
     * relationship between city and state
     *  city belongs to the state
     * type "fun" and let the autocompletion do its thing :-)
     */
    public function state()
    {
        # code...
        return $this->belongsTo(State::class);
    }

    /**
     * Summary of employees
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relationship->state has many employees
     */
    public function employees(){
        return $this->hasMany(Employee::class);
    }

}
