<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Novelty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_initial', 'f_final', 'type_nomina', 'observation',
    ];

    public function getRetiros($fecha, $nomina)
    {
    	return Employee::whereMonth('retirementdate', $fecha->month)
                        ->whereYear('retirementdate', $fecha->year)
                        ->where('type_nomina', $nomina)
                        ->get();
    }

    public function getIngresos($fecha, $nomina)
    {
    	return Employee::whereMonth('admissiondate', $fecha->month)
                        ->whereYear('admissiondate', $fecha->year)
                        ->where('type_nomina', $nomina)
                        ->get();
    }

    public function getAmortizaciones($fecha_inic, $fecha_final, $nomina)
    {
        return DB::table('employees')
                ->join('amortizacion_libranzas', 'employees.id', '=', 'amortizacion_libranzas.employee_id')
                ->where('fecha_inic', '>=', $fecha_inic)
                ->where('fecha_final', '<=', $fecha_final)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }

    public function getHolidays($fecha, $nomina)
    {
        return DB::table('employees')
                ->join('holidays', 'employees.id', '=', 'holidays.employee_id')
                ->whereMonth('since', $fecha->month)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }

    public function getTNLs($fecha, $nomina)
    {
        return DB::table('employees')
                ->join('tnls', 'employees.id', '=', 'tnls.employee_id')
                ->whereMonth('since', $fecha->month)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }

    public function getHEC($fecha, $nomina)
    {
        return DB::table('employees')
                ->join('hes', 'employees.id', '=', 'hes.employee_id')
                ->whereMonth('lapso', $fecha->month)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }

    public function getRetention($fecha, $nomina)
    {
        return DB::table('employees')
                ->join('retentions', 'employees.id', '=', 'retentions.employee_id')
                ->whereMonth('lapso', $fecha->month)
                ->where('employees.type_nomina', $nomina)
                ->get();
    }
}
