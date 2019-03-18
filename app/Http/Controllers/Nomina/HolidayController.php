<?php

namespace App\Http\Controllers\Nomina;

use App\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomina.novelty.holidays.list');
    }

    public function list()
    {
        $holidays = DB::table('employees')
                        ->join('holidays', function($join){
                            $join->on('employees.id', '=', 'holidays.employee_id');
                        })
                        ->select('employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'holidays.id', 'holidays.since', 'holidays.until', 'holidays.days')
                        ->groupBy('holidays.id','employees.id', 'employees.firstname', 'employees.lastname', 'employees.co', 'holidays.since', 'holidays.until', 'holidays.days')
                        ->orderBy('holidays.id', 'DES')
                        ->paginate(10);

        return $holidays;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomina.novelty.holidays.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Holiday $holiday)
    {
        $this->validate($request, [
                'since'       => 'required|date',
                'until'       => 'required|date',
                'days'        => 'required|numeric',
                'employee_id' => 'required|numeric'
            ]);

        $holiday->create($request->all());
        return $holiday;
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
    public function update(Request $request, Holiday $holiday)
    {
        $this->validate($request, [
                'since' => 'required|date',
                'until' => 'required|date',
                'days' => 'required|numeric'
            ]);

        $holiday->update($request->all());

        return $holiday;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
    }
}
