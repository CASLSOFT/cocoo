<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HE extends Model
{
    protected $table = "hes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lapso', 'typeHE', 'value','employee_id'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
