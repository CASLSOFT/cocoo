<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Holiday;
use App\Models\requisiciones\Order;
use App\TNL;
use Illuminate\Http\Request;

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

        return view('menus.nomina.dashboard', compact('empleados', 'tnl', 'vacaciones'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function requisiciones()
    {
        $orders = Order::with('user')->get();

        $mes = \Carbon\Carbon::now();

        $indicador = Order::whereMonth('created_at', \Carbon\Carbon::now())
                        ->groupBy('status')
                        ->orderBy('status', 'DESC')
                        // ->remember(1440)
                        ->get([
                            \DB::raw('status as label'),
                            \DB::raw('COUNT(*) as value')
                        ])
                        ->toJSON();

        return view('menus.requisiciones.dashboard', compact(['orders', 'indicador']));
    }
}
