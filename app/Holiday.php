<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{


    protected $fillable = ['since', 'until', 'days','employee_id'];

	protected $dates = ['since', 'until'];

    public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function getHolidays($fechainicial, $fechafinal, $nomina)
    {
        $holidays = Holiday::join('employees', 'employees.id', '=', 'holidays.employee_id')
                    ->where('employees.type_nomina', $nomina)
                    ->orWhereMonth('until', $fechafinal->month)
                    ->whereMonth('since', $fechainicial->month)
                    ->get();

        $filtered_collection = $holidays->filter(function($item) use ($nomina)
            {
                return $item['type_nomina'] === $nomina;
         });
        return $filtered_collection;
    }
}
