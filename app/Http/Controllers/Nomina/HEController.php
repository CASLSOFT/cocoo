<?php

namespace App\Http\Controllers\Nomina;

use App\HE;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomina.novelty.hes.list');
    }

    public function list()
    {
        $hes = DB::table('employees')
                        ->join('hes', function($join){
                            $join->on('employees.id', '=', 'hes.employee_id');
                        })
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'hes.id', 'hes.lapso', 'hes.value', 'hes.typeHE')
                        ->groupBy('hes.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'hes.lapso', 'hes.value', 'hes.typeHE')
                        ->orderBy('hes.id', 'DES')
                        ->paginate(2);

        return $hes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.novelty.hes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HE $he)
    {
        $this->validate($request, [
                'lapso'       => 'required|date',
                'value'       => 'required|numeric',
                'typeHE'      => 'required',
                'employee_id' => 'required|numeric'
            ]);

        $he->create($request->all());

        return $he;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HE $he)
    {
        $this->validate($request, [
                'lapso'  => 'required|date',
                'value'  => 'required|numeric',
                'typeHE' => 'required'
            ]);

        $he->update($request->all());

        return $he;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $he = HE::find($id);
        $he->delete();
        return $he;
    }
}
