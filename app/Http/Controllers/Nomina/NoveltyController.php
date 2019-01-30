<?php

namespace App\Http\Controllers\Nomina;

use App\AmortizacionLibranza;
use App\Employee;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Novelty;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NoveltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noveltys = Novelty::orderBy('id', 'DESC')->paginate(10);

        return response()->json($noveltys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.novelty.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Novelty $novelty)
    {
        $this->validate($request, [
            'f_initial' => 'required|date',
            'f_final'   => 'required|date',
            'type_nomina'   => 'required|in:P,F,T'
        ]);

        //validamos las amortizaciones
        if ($this->validateFechas($request)->count() > 0) {

            return redirect()->back()->withErrors(['message' => 'Novedad de este Lapso Creado']);

            // return new JsonResponse(['message' => 'Novedad de este Lapso Creado'], 422);
        }

        $novelty->create($request->all());

        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'f_initial' => 'required|date',
        //     'f_final'   => 'required|date',
        //     'type_nomina'   => 'required|in:P,F,T'
        // ]);
        $novelty = Novelty::findOrFail($id);

        $novelty->observation = $request->get("observation");
        
        $novelty->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novelty $novelty)
    {
        $novelty->delete();
    }

    public function validateFechas(Request $request)
    {
        $errors = Novelty::where('f_initial', '>=', $request->f_initial)
                  ->where('f_final', '<=', $request->f_final)
                  ->where('type_nomina', '=', $request->type_nomina)
                  ->get();
        
        return $errors;
    }

    public function pdf($id)
    {      
        $novelty = Novelty::findOrFail($id);
        $holiday = new Holiday();
        $fecha = Carbon::parse($novelty->f_initial);
        $nomina = $novelty->type_nomina;
        
        $ingresos = $novelty->getIngresos($fecha, $nomina);

        $retiros = $novelty->getRetiros($fecha, $nomina);

        $amortizacion = $novelty->getAmortizaciones($novelty->f_initial, $novelty->f_final, $nomina);

        $vacaciones = $holiday->getHolidays($fecha, $nomina);


        $tnls = $novelty->getTNLs($fecha, $nomina);

        $hec = $novelty->getHEC($fecha, $nomina);

        $retencion = $novelty->getRetention($fecha, $nomina);

        // Consultas para llenar PDF

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.novelty', compact('ingresos', 'retiros', 'amortizacion', 'vacaciones', 'tnls', 'hec', 'retencion', 'novelty'));
        $pdf->setPaper('letter');
        return $pdf->stream();
    }

    public function list()
    {
         $noveltys = Novelty::orderBy('id', 'DESC')->paginate(10);

        return view('nomina.novelty.list', compact('novelty'));
    }
}
