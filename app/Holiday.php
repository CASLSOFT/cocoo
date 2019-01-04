<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{

    protected $fillable = ['since', 'until', 'days','employee_id'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

}
