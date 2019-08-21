<?php

namespace App\Http\Controllers\Requisiciones;

use App\Http\Controllers\Controller;
use App\Models\requisiciones\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::paginate(5);
        return $providers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requisiciones.providers.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provider $provider)
    {
        $this->validate($request, [
            'nit'    => 'required|integer',
            'name'    => 'required|min:5',
            'payment' => 'required|min:3',
            'ment'    => 'required|min:3'
        ]);
        $provider->create($request->only(['nit', 'name', 'payment', 'ment']));

        return $provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $this->validate($request, [
            'name'    => 'required|min:5',
            'payment' => 'required|min:3',
            'ment'    => 'required|min:3'
        ]);
        $provider->update($request->only(['name', 'payment', 'ment']));

        return $provider;
    }
}
