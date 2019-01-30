<?php

namespace App\Http\Controllers\Nomina;

use App\AmortizacionLibranza;
use App\Http\Controllers\Controller;
use App\Libranza;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('nomina.libranzas.list');
    }

    public function list($status)
    {        
        $libranzas = DB::table('employees')
                        ->join('libranzas', function($join){
                            $join->on('employees.id', '=', 'libranzas.employee_id');
                        })                        
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'libranzas.id', 'libranzas.cuota_mensual', 'libranzas.cuota_quincenal', 'libranzas.cuota_de', 'libranzas.cuota_hasta', 'libranzas.entidad', 'libranzas.category', 'libranzas.status', 'libranzas.first_quincena')
                        ->groupBy('libranzas.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'libranzas.cuota_mensual', 'libranzas.cuota_quincenal', 'libranzas.cuota_de', 'libranzas.cuota_hasta', 'libranzas.entidad', 'libranzas.category', 'libranzas.status', 'libranzas.first_quincena'  )
                        ->orderBy('employees.firstname', 'ASC')
                                ->where('libranzas.status', $status)
                        ->paginate(10);
        
        return $libranzas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.libranzas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Libranza $libranza)
    {
        $this->validate($request, [
            'cuota_mensual'   => 'required|numeric',
            'cuota_quincenal' => 'numeric',
            'cuota_de'        => 'numeric',
            'cuota_hasta'     => 'numeric',
            'entidad'         => 'required|min:3',
            'category'        => 'required'
        ]);

        $libranza->create($request->all());

        return $libranza;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libranza $libranza)
    {
        $this->validate($request, [
            'cuota_mensual'   => 'required|numeric',
            'cuota_quincenal' => 'numeric',
            'cuota_de'        => 'numeric',
            'cuota_hasta'     => 'numeric',
            'entidad'         => 'required|min:3',
            'category'        => 'required'
        ]);

        $libranza->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function active($id)
    {
        $libranza = Libranza::findOrFail($id);

        $libranza->status = !$libranza->status;

        $libranza->save();

        $libranzas = DB::table('employees')
                        ->join('libranzas', function($join){
                            $join->on('employees.id', '=', 'libranzas.employee_id')
                                ->where('libranzas.status', 1);
                        })                        
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'libranzas.id', 'libranzas.cuota_mensual', 'libranzas.cuota_quincenal', 'libranzas.cuota_de', 'libranzas.cuota_hasta', 'libranzas.entidad', 'libranzas.category', 'libranzas.status')
                        ->groupBy('libranzas.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'libranzas.cuota_mensual', 'libranzas.cuota_quincenal', 'libranzas.cuota_de', 'libranzas.cuota_hasta', 'libranzas.entidad', 'libranzas.category', 'libranzas.status')
                        ->orderBy('employees.firstname', 'ASC')
                        ->paginate(10);

        return $libranzas;
    }

    public function validateFechas(Request $request)
    {
        $errors = AmortizacionLibranza::where('fecha_inic', '>=', $request->fecha_inic)
                  ->where('fecha_final', '<=', $request->fecha_final)
                  ->get();
                  
        return $errors;
    }

    //validamos que las cuotas se pueda liquidar
    public function validateQuincenaAmortizar(Request $request)
    {
        $fecha_inic = $request->fecha_inic;
        $fecha_final = $request->fecha_final;

        $fecha_inic = explode('-', $fecha_inic);
        $fecha_final = explode('-', $fecha_final);

        if ($fecha_inic[2] == 1 && $fecha_final[2] == 15) {
            return true;
        }

        return false;
    }

    public function amortizar(Request $request)
    {

        $this->validate($request, [
            'fecha_inic' => 'required|date',
            'fecha_final' => 'required|date'
        ]);

        if ($request->first_quincena) {
            
        }


        //validamos las amortizaciones
        if ($this->validateFechas($request)->count() > 0) {
            return new JsonResponse(['message' => 'Periodo Amortizado'], 422);
        }
        
        //consultamnos si podemos amortizar las libranzas de empleados con la marcasion primera quincena
        $quincena = $this->validateQuincenaAmortizar($request);


        //aumentamos en 1 la cuota_de todas las libranzas
        if ($quincena) {
            $cuotas = DB::table('libranzas')
                        ->where('status', true)
                        ->update(['cuota_de' => DB::raw('ROUND(cuota_de + 1)')]);

            //consultamos todas las libranzas activas
            $libranzas = Libranza::where('status', true)                        
                        ->get();
        }

        //aumentamos en 1 la cuota_de de las libranzas de la segunda quincena
        if (!$quincena) {
            $cuotas = DB::table('libranzas')
                        ->where('status', true)
                        ->where('first_quincena', false)
                        ->update(['cuota_de' => DB::raw('ROUND(cuota_de + 1)')]);
            
            //consultamos todas las libranzas activas
            $libranzas = Libranza::where('status', true)
                        ->where('first_quincena', false)                    
                        ->get();
        }


        //actualizamos las libranzas completadas
        $libranzascomplete = DB::table('libranzas')
                            ->whereRaw('cuota_de >= cuota_hasta')
                            ->where('status', true)
                            ->update(['status' => 0]);

        //guardamos las amortizaciones
        $amorizacion = new AmortizacionLibranza;
        foreach ($libranzas as $libranza) {            
            $amorizacion->create([
                'cuota_mensual'   => $libranza['cuota_mensual'],
                'cuota_quincenal' => $libranza['cuota_quincenal'],
                'cuota_de'        => $libranza['cuota_de'],
                'cuota_hasta'     => $libranza['cuota_hasta'],
                'entidad'         => $libranza['entidad'],
                'category'        => $libranza['category'],
                'employee_id'     => $libranza['employee_id'],
                'fecha_inic'      => $request->get('fecha_inic'),
                'fecha_final'     => $request->get('fecha_final'),
            ]);
        }
        
        //return $libranzas;
    }
}
