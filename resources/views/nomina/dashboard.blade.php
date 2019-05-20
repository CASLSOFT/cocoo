@extends('layouts.nomina')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW TASKS</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">flight_takeoff</i>
                    </div>
                    <div class="content">
                        <div class="text" align="center">Vacaciones de {{ date("F") }}</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" align="center">{{ $vacaciones }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">event_seat</i>
                    </div>
                    <div class="content">
                        <div class="text" align="center">TNLs de {{ date("F") }}</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" align="center">{{ $tnl }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="content">
                        <div class="text" align="center">Empleados Activos</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" align="center">{{ $empleados }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
    </div>
@endsection

@section('footer-scripts')

@endsection