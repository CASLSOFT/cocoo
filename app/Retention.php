<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retention extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Ingresos => income
    protected $fillable = ['lapso','income', 'value', 'process','employee_id'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
