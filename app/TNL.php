<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNL extends Model
{
    protected $table = "tnls";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['since', 'until', 'days','employee_id', 'typeTNL'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
