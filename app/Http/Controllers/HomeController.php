<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\TNL;
use App\Holiday;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function nomina()
    {
        $empleados = Employee::where('retirementdate')->count();
        $tnl = TNL::whereMonth('since', date('m'))->count();
        $vacaciones = Holiday::whereMonth('since', date('m'))->count();

        return view('nomina.dashboard', compact('empleados', 'tnl', 'vacaciones'));
    }
}
