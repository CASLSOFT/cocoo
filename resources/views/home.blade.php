@extends('layouts.AdminBSB')

@section('title')
    Home
@endsection

@section('page-header')
    Home
@endsection

@section('page-content')
    <div class="row">
        <div class="col-md-4">
            <a href="#">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <h2>
                                Requisiciones                        
                            </h2>                        
                        </div>
                        <div class="col-md-4 pt-5">
                            <i class="material-icons" style="font-size: 50px; padding-top: 5px">list_alt</i>
                        </div> 
                    </div>
                </div>                
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('nomina') }}">
                <div class="panel panel-info">                
                    <div class="panel-body">
                        <div class="col-md-8">
                            <h2>
                                Nomina
                            </h2>                        
                        </div>
                        <div class="col-md-4">
                            <i class="material-icons" style="font-size: 50px; padding-top: 5px">attach_money</i>                        
                        </div>                         
                    </div>
                </div>                
            </a>
        </div>
        <div class="col-md-4">
            <a href="#">
                <div class="panel panel-info ">                
                    <div class="panel-body">
                        <div class="col-md-8">
                            <h2>
                                Activos Fijos
                            </h2>                        
                        </div>
                        <div class="col-md-4">
                            <i class="material-icons" style="font-size: 50px; padding-top: 5px">text_format</i>
                        </div> 
                    </div>
                </div>                
            </a>
        </div>        
    </div>
@endsection
