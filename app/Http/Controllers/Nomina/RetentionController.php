<?php

namespace App\Http\Controllers\Nomina;

use App\Http\Controllers\Controller;
use App\Retention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetentionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomina.novelty.retentions.list');
    }

    public function list()
    {
        $retentions = DB::table('employees')
                        ->join('retentions', function($join){
                            $join->on('employees.id', '=', 'retentions.employee_id');
                        })
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'retentions.id', 'retentions.lapso', 'retentions.income', 'retentions.value','retentions.process')
                        ->groupBy('retentions.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'retentions.lapso', 'retentions.income', 'retentions.value', 'retentions.process')
                        ->orderBy('retentions.id', 'DES')
                        ->paginate(10);

        return $retentions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.novelty.retentions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retention $retention)
    {
        $this->validate($request, [
                'lapso'       => 'required|date',
                'income'      => 'required|numeric',
                'value'       => 'required|numeric',
                'process'     => 'required|numeric',
                'employee_id' => 'required|numeric'
            ]);

        $retention->create($request->all());

        return $retention;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retention $retention)
    {
        $this->validate($request, [
                'lapso'   => 'required|date',
                'income'  => 'required|numeric',
                'value'   => 'required|numeric',
                'process' => 'required|numeric'
            ]);

        $retention->update($request->all());

        return $retention;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retention = Retention::find($id);
        $retention->delete();
        return $retention;
    }
}
