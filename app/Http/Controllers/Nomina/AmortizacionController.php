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
            'cuota_mensual'   => 'required|numeric',
            'cuota_quincenal' => 'numeric',
            'cuota_de'        => 'numeric',
        ]);

        $amortizacion = AmortizacionLibranza::findOrFail($id);
        
        $amortizacion->cuota_mensual = $request->cuota_mensual;
        $amortizacion->cuota_quincenal = $request->cuota_quincenal;
        $amortizacion->cuota_de = $request->cuota_de;

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
        if ($category) {
            $amorizacion = AmortizacionLibranza::where('employee_id', $id)
                            ->where('catgeory', $category)
                            ->paginate(2);            
        } else {
            $amorizacion = AmortizacionLibranza::where('employee_id', $id)
                            ->paginate(2);            
        }


        return $amorizacion;
    }
}
