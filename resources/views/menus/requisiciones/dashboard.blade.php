@extends('layouts.requisiciones')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>PANEL DE CONTROL REQUISICIONES</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <a href="{{ url('/requisiciones/papeleria') }}">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text">Realizar Pedido de Papeleria</div>
                        {{-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <a href="{{ url('/requisiciones/aseo') }}">
                        <div class="icon">
                            <i class="material-icons">local_laundry_service</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text" align="center">Realizar Pedido de Aseo</div>
                        {{-- <div class="number count-to" data-from="0" data-to="257" data-speed="1000" align="center">0</div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <a href="{{ url('/requisiciones/cafeteria') }}">
                        <div class="icon">
                            <i class="material-icons">local_cafe</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text" align="center">Realizar Pedido de Cafeteria</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <a href="{{ url('requisiciones/drafts') }}">
                        <div class="icon">
                            <i class="material-icons">drafts</i>
                        </div>
                    </a>
                    <div class="content">
                        <div class="text" align="center">Pedidos en Borrador</div>
                        {{-- <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" align="center">0</div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        {{-- barra de progeso del pedido y resultado del indicador --}}
        <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>SEGUIMIENTO A LAS REQUISICIONES</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Categoria</th>
                                            <th>Responsable</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $element)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $element->user->firstname }} {{ $element->user->lastname }}</td>
                                                <td><span class="label bg-{{ classActive($element->puntuacion - 1) }}">{{ $element->status}}</span></td>
                                                <td>{{ $element->category }}</td>
                                                <td>{{ $element->responsable }}</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-{{ classActive($element->puntuacion - 1) }}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ $element->puntuacion/5*100 }}%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>ESTADO DE LAS REQUISICONES</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        {{-- END barra de progreso e indicador --}}
    </div>

@endsection

@section('footer-scripts')
<!-- Morris Plugin Js -->
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>

@endsection
@section('footer-scripts-graficas')

<script type="text/javascript">

    // var data = JSON.parse('{!! $indicador !!}');
    $(function () {
        Morris.Donut({
                element: 'donut_chart',
                data: {!! $indicador !!},
                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],
                formatter: function (y) {
                    return (y > 1) ? y + ' Ordenes' : y + ' Orden';
                }
            });
    });
</script>
@endsection