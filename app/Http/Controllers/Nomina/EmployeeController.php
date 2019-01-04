<?php

namespace App\Http\Controllers\Nomina;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.list', compact('employees'));
    }

    public function list()
    {
        $employees = Employee::where('retirementdate')
                    ->orderBy('firstname', 'ASC')
                    ->paginate(10);

        return response()->json($employees);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $employees = Employee::where('firstname','like','%'.$query.'%')
                            ->where('retirementdate')
                            ->get();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'identificacion' =>'required|min:6|numeric|unique:employees,identificacion',
            'typecc'         =>'required|in:CC,TI,Otro',
            'firstname'      =>'required|min:3',
            'lastname'       =>'required|min:3',
            'email'          =>'required|unique:employees,email',
            'area'           =>'required|in:administracion,comercial,farmacia',
            'CO'             => 'required',
            'type_nomina'   => 'required|in:P,F,T',
            'admissiondate'  =>'required|date',
            'salary'         =>'required|numeric'
        ]);

        $employee->create($request->all());

        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return $employee;
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
        $this->validate($request, [
            'identificacion' =>'required|min:6|numeric|unique:employees,identificacion,' . $id,
            'typecc'         =>'required|in:CC,TI,Otro',
            'firstname'      =>'required|min:3',
            'lastname'       =>'required|min:3',
            'email'          =>'required|unique:employees,email,' . $id,
            'area'           =>'required|in:administracion,comercial,farmacia',            
            'CO'             =>'required',
            'type_nomina'   => 'required|in:P,F,T',
            'admissiondate'  =>'required|date',
            'salary'         =>'required|numeric'
            ]);

        Employee::findOrFail($id)->update($request->all());

        return;
    }
}
