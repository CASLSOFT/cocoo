<?php

namespace App\Http\Controllers\Nomina;

use App\AmortizacionLibranza;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmortizacionController extends Controller
{
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha_inic'   => 'required|date',
            'fecha_final'   => 'required|date',
            'cuota_mensual'   => 'required|numeric',
            'cuota_quincenal' => 'numeric',
            'cuota_de'        => 'numeric',
            'cuota_hasta'        => 'numeric',
            'category'   => 'required',
            'entidad'   => 'required',
        ]);

        $amortizacion = AmortizacionLibranza::findOrFail($id);

        $amortizacion->fecha_inic = $request->fecha_inic;
        $amortizacion->fecha_final = $request->fecha_final;
        $amortizacion->cuota_mensual = $request->cuota_mensual;
        $amortizacion->cuota_quincenal = $request->cuota_quincenal;
        $amortizacion->cuota_de = $request->cuota_de;
        $amortizacion->cuota_hasta = $request->cuota_hasta;
        $amortizacion->entidad = $request->entidad;
        $amortizacion->category = $request->category;

        $amortizacion->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amortizacion = AmortizacionLibranza::findOrFail($id);
        $amortizacion->delete();
    }

    public function getAmortizaciones()
    {
        $amorizacion = AmortizacionLibranza::select('fecha_inic', 'fecha_final')
                        ->groupBy('fecha_inic', 'fecha_final')
                        ->get();

        return $amorizacion;
    }

    public function tbamortizacion()
    {
        return view('nomina.libranzas.tbAmortizacion');
    }

    public function amortizacionEmployee($id, $category)
    {
        $amorizacion = AmortizacionLibranza::where('employee_id', $id)
                            ->where('category', $category)
                            ->paginate(10);

        return $amorizacion;
    }

    public function getaddtbamortizacion()
    {
        return view('nomina.libranzas.addAmortizacion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addtbamortizacion(Request $request, AmortizacionLibranza $amorizacionlibranza)
    {
        $this->validate($request, [
            'cuota_mensual'   => 'required|numeric',
            'cuota_quincenal' => 'numeric',
            'cuota_de'        => 'numeric',
            'cuota_hasta'     => 'numeric',
            'entidad'         => 'required|min:3',
            'category'        => 'required'
        ]);

        $amorizacionlibranza->create($request->all());

        return $amorizacionlibranza;
    }
}
