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

    public function getHolidaysYear()
    {
         return Holiday::select('holidays.id', 'holidays.since', 'holidays.until', 'holidays.days', 'employees.firstname',
                    'employees.lastname', 'employees.CO', 'employees.type_nomina', 'employees.admissiondate', 'holidays.employee_id')
                    ->join('employees', 'employees.id', '=', 'holidays.employee_id')
                    ->Whereyear('since', date("Y"));
    }

    public function getHolidaysNovelty($novelty, $mes)
    {
        $holiday = $this->getHolidaysYear();

        if ($mes === 1) {
            $holiday = $holiday->whereMonth('since', '12')->orwheremonth('until', $mes)->orwhereyear('since', date("Y") - 1)->get();
        } else {
            $holiday = $holiday->whereMonth('since', $mes)->orwheremonth('until', $mes)->get();
        }

        $holidayNovelty = $holiday->filter(function($item) use ($novelty) {
            return $item['type_nomina'] === $novelty->type_nomina;
        });

        return $holidayNovelty;
    }


}
