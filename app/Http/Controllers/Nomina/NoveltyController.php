<?php

namespace App\Http\Controllers\Nomina;

use App\AmortizacionLibranza;
use App\Employee;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Novelty;
use App\TNL;
use App\Exports\NoveltysExport;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

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
        $TNL = new TNL();
        $fechainicial = Carbon::parse($novelty->f_initial);
        $fechafinal = Carbon::parse($novelty->f_final);
        $nomina = $novelty->type_nomina;

        $ingresos = $novelty->getIngresos($fechainicial, $nomina);

        $retiros = $novelty->getRetiros($fechainicial, $nomina);

        $amortizacion = $novelty->getAmortizaciones($novelty->f_initial, $novelty->f_final, $nomina);

        $vacaciones = $holiday->getHolidaysNovelty($novelty, $fechainicial->month);

        $tnls = $TNL->getTNLsNovelty($novelty, $fechafinal, $fechafinal);
        $lms = $TNL->getLMNovelty($novelty, $fechafinal, $fechafinal);

        $hec = $novelty->getHEC($fechainicial, $nomina);

        $retencion = $novelty->getRetention($fechainicial, $nomina);

        // Consultas para llenar PDF

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.novelty', compact('ingresos', 'retiros', 'amortizacion', 'vacaciones', 'tnls', 'lms', 'hec', 'retencion', 'novelty'));
        $pdf->setPaper('letter');
        return $pdf->stream();
        // return $pdf->download('novedades.pdf');
    }

    public function excel($id)
    {
        $novelty = Novelty::findOrFail($id);
        $holiday = new Holiday();
        $TNL = new TNL();
        $fechainicial = Carbon::parse($novelty->f_initial);
        $fechafinal = Carbon::parse($novelty->f_final);
        $nomina = $novelty->type_nomina;

        $ingresos = $novelty->getIngresos($fechainicial, $nomina);

        $retiros = $novelty->getRetiros($fechainicial, $nomina);

        $amortizacion = $novelty->getAmortizaciones($novelty->f_initial, $novelty->f_final, $nomina);

        $vacaciones = $holiday->getHolidaysNovelty($novelty, $fechainicial->month);

        $tnls = $TNL->getTNLsNovelty($novelty, $fechafinal, $fechafinal);
        $lms = $TNL->getLMNovelty($novelty, $fechafinal, $fechafinal);

        $hec = $novelty->getHEC($fechainicial, $nomina);

        $retencion = $novelty->getRetention($fechainicial, $nomina);

        return Excel::create('Novedades del mes ' . $fechainicial->month, function($excel) use ($ingresos, $retiros, $amortizacion, $vacaciones, $tnls, $lms, $hec, $retencion, $novelty){
            $excel->sheet($novelty->f_initial . 'al ' . $novelty->f_final,
            function($sheet) use ($ingresos, $retiros, $amortizacion, $vacaciones, $tnls, $lms, $hec, $retencion, $novelty){
                $sheet->loadView('excel.novelty', compact('ingresos', 'retiros', 'amortizacion', 'vacaciones', 'tnls', 'lms', 'hec', 'retencion', 'novelty'));
            });
        })->download('xlsx');
    }

    public function list()
    {
         $noveltys = Novelty::orderBy('id', 'DESC')->paginate(10);

        return view('nomina.novelty.list', compact('novelty'));
    }

    // public function prueba($id)
    // {
    //     $tnl = new TNL();
    //     $novelty = Novelty::findOrFail($id);

    //     $mes2 = Carbon::parse($novelty->f_final);
    //     $mes1 = Carbon::parse($novelty->f_initial);

    //     return $tnl->getLMNovelty($novelty, $mes1, $mes2);
    // }
    // public function export_xls($expense_id, $file_format_id)
    // {
    //     $expense = Expense::find($expense_id);
    //     $file_format = FileFormat::find($file_format_id);
    //     $routes = DB::table('buy_orders') ->join('expenses','expenses.id','=','buy_orders.expense_id')
    //         ->join('users','expenses.user_id','=','users.id') ->select( 'buy_orders.code', 'buy_orders.cost_center', 'buy_orders.book_account', 'buy_orders.active', 'buy_orders.expenditure', 'buy_orders.inventory', 'buy_orders.quantity', 'buy_orders.price_unit', 'buy_orders.description', 'buy_orders.estimated_value', 'buy_orders.destination', 'buy_orders.delivery_date' )
    //         ->where('buy_orders.expense_id','=',$expense_id)
    //         ->orderBy('buy_orders.created_at','desc')
    //         ->get();

    //     $data = json_decode(json_encode((array) $routes), true);

    //     Excel::load('/storage/app/template.xls', function($file) use($expense, $data){
    //         $file->setActiveSheetIndex(0)
    //         ->setCellValue('D8', $expense->user->name);

    //         $file->setActiveSheetIndex(0)
    //         ->setCellValue('L8', $expense->application_date);

    //         $file->setActiveSheetIndex(0)
    //         ->setCellValue('P8', $expense->code);

    //         $file->setActiveSheetIndex(0)
    //         ->setCellValue('D45', $expense->description);

    //         $row = 13; foreach($data as $key => $temp) {
    //             $col = 1;
    //             foreach(array_keys($temp) as $value) {
    //                 $file->getActiveSheet()
    //                 ->setCellValueByColumnAndRow($col, $row, $temp[$value]);
    //                 $col++;
    //             } $row++;
    //         } })->export('xls');
    // }
}
