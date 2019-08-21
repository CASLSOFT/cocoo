@extends('layouts.requisiciones')

@section('title')
    CREACION DE COMENTARIO
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>DETALLE DE ARTICULOS</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ url('/requisiciones/user/list') }}" class=" waves-effect waves-block">Mis Ordenes</a></li>
                                <li><a href="{{ url('requisiciones/drafts') }}" class=" waves-effect waves-block">Ordenes Borrador</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DESCRIPCIÓN</th>
                                <th>CATEGORIA</th>
                                <th>USERNAME</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $element)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $element->name }}</td>
                                <td>{{ $element->category }}</td>
                                <td><img src="{{ asset($element->imagen) }}" class="img-thumbnail" style="width: 40px; height: 40px;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')

@endsection