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

    {{-- <div class="container">
        <div class="box box-1">
            <div class="cover"><img src="https://upload-images.jianshu.io/upload_images/3433202-893bc9989a52eba0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" alt=""></div>
            <a href="#">
                <button class="menusanimados"><div></div></button>                
            </a>
        </div>
        <div class="box box-2">
            <div class="cover"><img src="https://upload-images.jianshu.io/upload_images/3433202-964edcf0f07211b0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" alt=""></div>
            <a href="{{ route('nomina') }}">
                <button class="menusanimados"><div></div></button>
            </a>
        </div>
        <div class="box box-3">
            <div class="cover"><img src="https://upload-images.jianshu.io/upload_images/3433202-2ebb2b6f93add843.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" alt=""></div>
            <a href="#">
                <button class="menusanimados"><div></div></button>                
            </a>
        </div>
        <div class="box box-4">
            <div class="cover"><img src="https://upload-images.jianshu.io/upload_images/3433202-f79c4cc8de2f84ae.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" alt=""></div>
            <a href="#">
                <button class="menusanimados"><div></div></button>                
            </a>
        </div>
    </div> --}}

@endsection
