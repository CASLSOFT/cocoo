<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libranza extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cuota_mensual', 'cuota_quincenal', 'cuota_de', 'cuota_hasta', 'entidad', 'status', 'category', 'employee_id'
    ];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
