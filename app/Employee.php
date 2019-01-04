<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    	'typecc', 
    	'identificacion',
    	'firstname', 
    	'lastname', 
    	'email', 
    	'area', 
    	'CO', 
    	'type_nomina',
    	'admissiondate', 
    	'retirementdate', 
    	'salary'
    ];

    public function libranzas()
    {
        return $this->hasMany(Libranza::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function tnls()
    {
        return $this->hasMany(TNL::class);
    }
}
