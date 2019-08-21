<?php

namespace App\Http\Controllers\Requisiciones;

use App\Http\Controllers\Controller;
use App\Models\requisiciones\Order;
use App\Models\requisiciones\DetailOrder;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['quantity' => 'required|integer']);

        $detailorder = DetailOrder::create($request->only(['article_id', 'order_id', 'quantity']));

        return redirect()->back();
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
        $detailorder = DetailOrder::where('id', $request->id)->first();
        $detailorder->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailorder = DetailOrder::where('id', $id)->first();
        $detailorder->delete();
    }
}
