@extends('layouts.requisiciones')

@section('title')
    CREACION DE COMENTARIO
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <!-- Basic Validation -->
        @can('order.edit')
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>ADICIÓN DE COMENTARIO</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <form name="formulario" method="post" action="{{ route('order.update', $order) }}" >
                            @csrf()
                            @method('PUT')
                            <div class="body">
                            <h2 class="card-inside-title">Orden # {{ $order->id }} de {{ $order->category }} con Fechas {{ $order->created_at }}</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Adiciona un comentario a orden de pedido..." name="observations"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button class="btn btn-primary waves-effect" type="submit">GUARDAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        <!-- #END# Basic Validation -->
    </div>
@endsection

@section('footer-scripts')

@endsection