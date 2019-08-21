<?php

namespace App\Http\Controllers\Requisiciones;

use App\Http\Controllers\Controller;
use App\Models\requisiciones\DetailOrder;
use App\Models\requisiciones\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->category = $request->category;
        $order->status = 'BORRADOR';
        $order->puntuacion = 1;
        $order->responsable = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $order->area = Auth::user()->area;
        $order->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DetailOrder::where('order_id', $id)
                ->join('articles', 'detail_orders.article_id', '=', 'articles.id')
                ->select('detail_orders.quantity', 'detail_orders.id as article_id', 'articles.name', 'articles.category', 'articles.imagen')
                ->get();

        return view('requisiciones.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('requisiciones.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->only(['observations']));

        return redirect()->route('lists.orderxuser');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->only(['draft', 'status', 'puntuacion', 'responsable']));
        return redirect()->route('lists.orderxuser');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approvalOrder($id)
    {
        $now = new \DateTime();

        $order = Order::findOrFail($id);
        $order->status = 'COMPRANDO';
        $order->puntuacion = 3;
        $order->dateapproval = $now->format('Y-m-d H:i:s');
        $order->responsable = 'AUX. CONTABLE';
        $order->approval_id = Auth::user()->id;
        $order->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receivedOrder($id)
    {
        $now = new \DateTime();

        $order = Order::findOrFail($id);
        $order->datereceived = $now->format('Y-m-d H:i:s');
        $order->status = 'RECIBIDO';
        $order->puntuacion = 5;
        $order->responsable = Auth::user()->full_name;
        $order->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function despachoOrder(Request $request, $id)//devuelva las ordenes en despacho
    {
        $order = Order::findOrFail($id);
        $order->update($request->only(['status', 'puntuacion', 'responsable']));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activeUser($category)//devuelva las ordenes en borrador de cada usuario segun la categoria
    {
        $user = Auth::user()->id;
        $order = Order::select('id','draft')->where('user_id', $user)->where('draft', 1)->where('category', $category)->first();

        return response()->json($order);
    }

    public function draftsUser()// devuelve las ordenes en borrador por usuario
    {
        $user = Auth::user()->id;
        $orders = Order::where('user_id', $user)->where('draft', 1)->get();

        return response()->json($orders);
    }

    public function draftsStationaryUser()
    {
        $user = Auth::user()->id;

        return Order::where('user_id', $user)->where('draft', 1)->where('articles.category', 'papeleria')
                    ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
                    ->join('articles', 'detail_orders.article_id', '=', 'articles.id')
                    ->select('orders.id', 'orders.draft', 'detail_orders.quantity', 'detail_orders.id as article_id', 'articles.name', 'articles.category', 'articles.imagen')
                    ->paginate(5);
    }

    public function draftsCleanlinessUser()
    {
        $user = Auth::user()->id;

        return Order::where('user_id', $user)->where('draft', 1)->where('articles.category', 'aseo')
                    ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
                    ->join('articles', 'detail_orders.article_id', '=', 'articles.id')
                    ->select('orders.id', 'orders.draft', 'detail_orders.quantity', 'detail_orders.id as article_id', 'articles.name', 'articles.category', 'articles.imagen')
                    ->paginate(5);
    }

    public function draftsCephetryUser()
    {
        $user = Auth::user()->id;

        return Order::where('user_id', $user)->where('draft', 1)->where('articles.category', 'cafeteria')
                    ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
                    ->join('articles', 'detail_orders.article_id', '=', 'articles.id')
                    ->select('orders.id', 'orders.draft', 'detail_orders.quantity', 'detail_orders.id as article_id', 'articles.name', 'articles.category', 'articles.imagen')
                    ->paginate(5);
    }

    public function listUser()
    {
        return datatables()
                ->eloquent(Order::where('user_id', Auth::user()->id))
                ->addColumn('btn', 'requisiciones.order.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    public function listOrderDespacho()
    {
        return datatables()
                ->eloquent(Order::where('status', 'DESPACHO')->with('user'))
                ->addColumn('btn', 'requisiciones.order.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    public function listOrderShopping()
    {
        return datatables()
                ->eloquent(Order::with('user'))
                ->addColumn('btn', 'requisiciones.order.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    public function approvalOrderUserArea()
    {
        $ordenes = Order::where('status', 'APROBACION')->where('area', Auth::user()->area)->with('user', 'detailorders.article')->get();
        return $ordenes;
    }
}
