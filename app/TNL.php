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

    public function getTNLsYear()
    {
         return TNL::select('tnls.id', 'tnls.since', 'tnls.until', 'tnls.days', 'tnls.typeTNL', 'employees.firstname',
                    'employees.lastname', 'employees.CO', 'employees.type_nomina', 'employees.admissiondate', 'tnls.employee_id')
                    ->join('employees', 'employees.id', '=', 'tnls.employee_id')
                    ->Whereyear('since', date("Y"));
    }

    public function getTNLsNovelty($novelty, $f_inicial, $f_final)
    {
        $tnl = $this->getTNLsYear();       //instnaciamos la consulta de los TNL sin incluir las licencias de maternidad

        if ($f_final->day === 15 && $f_final->month === 1) {
            $tnl = $tnl->whereMonth('since', '12')
                    ->orwhere('until', '<=', $f_final)
                    ->orwhereyear('since', date("Y") - 1)
                    ->where('typeTNL', '<>', 'LM')
                    ->get();
        } elseif($f_final->day === 15) {
            $tnl = $tnl->whereMonth('since', $f_final->month)->where('until', '<=', $f_final)->where('typeTNL', '<>', 'LM')->get();
        } else {
            $tnl = $tnl->whereMonth('since', $f_final)->where('until', '<=', $f_final)->where('typeTNL', '<>', 'LM')->get();
        }

        $tnlsNovelty = $tnl->filter(function($item) use ($novelty) {
            return $item['type_nomina'] === $novelty->type_nomina;
        });

        return $tnlsNovelty;
    }

    public function getLMNovelty($novelty, $f_inicial, $f_final)
    {
        $lm = $this->getTNLsYear();       //instnaciamos la consulta de los TNL

        $lm = $lm->where('typeTNL', 'LM')->orwhereyear('since', date("Y") - 1)->get();

        foreach ($lm as $key => $value) {
            list($year, $month, $day) = explode('-', $value['until']);

            if ($value['since'] <= $f_inicial->format('Y-m-d') && $year == $f_final->year && $month >= $f_final->month && $value['type_nomina'] == $novelty->type_nomina) {
                $result[$key] = $value;
            }else {
                $result = [];
            }
        }

        return $result;
    }
}
