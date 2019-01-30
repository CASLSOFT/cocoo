<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{


    protected $fillable = ['since', 'until', 'days','employee_id'];

	protected $appends = ['fechaIngreso'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function getFechaIngresoAttribute()
    {
        return Carbon::createFromFormat('Y-m-d','2019-01-23' )->addDay()->toDateTimeString();
    }

    public function getHolidays($fecha, $nomina)
    {
        return \DB::table('holidays')
                ->join('employees', 'employees.id', '=', 'holidays.employee_id')
                ->whereMonth('since', $fecha->month)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }
}
