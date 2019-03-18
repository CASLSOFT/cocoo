<?php

namespace App\Http\Controllers\Nomina;

use App\Http\Controllers\Controller;
use App\TNL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TNLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomina.novelty.tnls.list');
    }

    public function list()
    {        
        $tnls = DB::table('employees')
                        ->join('tnls', function($join){
                            $join->on('employees.id', '=', 'tnls.employee_id');
                        })                        
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'tnls.id', 'tnls.since', 'tnls.until', 'tnls.days', 'tnls.typeTNL')
                        ->groupBy('tnls.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'tnls.since', 'tnls.until', 'tnls.days', 'tnls.typeTNL')
                        ->orderBy('tnls.id', 'DES')
                        ->paginate(10);
        
        return $tnls;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.novelty.tnls.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TNL $tnl)
    {
        $this->validate($request, [
                'since'       => 'required|date',
                'until'       => 'required|date',
                'days'        => 'required|numeric',
                'typeTNL'     => 'required',
                'employee_id' => 'required|numeric'
            ]);

        $tnl->create($request->all());

        return $tnl;
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
    public function update(Request $request, TNL $tnl)
    {
        $this->validate($request, [
                'since'       => 'required|date',
                'until'       => 'required|date',
                'days'        => 'required|numeric',
                'typeTNL'     => 'required'                
            ]);

        $tnl->update($request->all());

        return $tnl;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TNL $tnl)
    {
        return $tnl->delete();
    }
}
