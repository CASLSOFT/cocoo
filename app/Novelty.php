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
                ->orderBy('Amortizacion_libranzas.entidad')
                ->orderBy('Employees.lastname')
                ->get();
    }

    // public function getTNLs($fecha, $nomina)
    // {
    //     $tnls = TNL::select('tnls.id', 'tnls.since', 'tnls.until', 'tnls.typeTNL', 'tnls.days', 'employees.firstname',
    //                 'employees.lastname', 'employees.CO', 'employees.type_nomina', 'employees.admissiondate', 'tnls.employee_id')
    //                 ->join('employees', 'employees.id', '=', 'tnls.employee_id')
    //                 ->Whereyear('since', date("Y"));
    // }

    public function getHEC($fechainicial, $fechafinal, $nomina)
    {
        return DB::table('employees')
                ->join('hes', 'employees.id', '=', 'hes.employee_id')
                ->whereBetween('lapso', [$fechainicial, $fechafinal])
                ->where('employees.type_nomina', $nomina)
                ->get();
    }

    public function getRetention($fechainicial, $fechafinal, $nomina)
    {
        return DB::table('employees')
                ->join('retentions', 'employees.id', '=', 'retentions.employee_id')
                ->whereBetween('lapso', [$fechainicial, $fechafinal])
                ->where('employees.type_nomina', $nomina)
                ->get();
    }
}
