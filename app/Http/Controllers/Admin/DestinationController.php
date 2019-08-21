<?php

namespace App\Http\Controllers\Admin;

use App\Destination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('destination.destination');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $destination = Destination::where('status', true)->paginate(5);

        return $destination;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Destination $destination)
    {
        $this->validate($request, [
            'code' => 'required|min:3|max:6',
            'description' => 'required|min:5|max:30'
        ]);

        $destination->create($request->all());

        return $destination;
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
            'code' => 'required|min:3|max:6',
            'description' => 'required|min:5|max:30'
        ]);

        $destination = Destination::findOrFail($id)->update([
            'code' => $request->code,
            'description' => $request->description
        ]);
    }
}
