@extends('layouts.requisiciones')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CREACION DE ARTICULOS
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    @can('article.list')
                                    <li><a href="{{ route('article.index') }}">Lista Articulos</a></li>
                                    @endcan
                                    @can('provider.create', Model::class)
                                    <li><a href="{{ route('provider.create') }}">Crear Proveedor</a></li>
                                    @endcan
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        @can('article.create')
                        <div class="row">
                            <form name="formulario" method="post" action="{{ route('article.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf()
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required>
                                            <label class="form-label">Nombre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="trademark" required>
                                            <label class="form-label">Marca</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="unit" required>
                                            <label class="form-label">Unidad</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">attach_money</i></span>
                                        <div class="form-line">
                                            <input type="number" class="form-control money-dollar text-center" placeholder="Costo  Ex: 9999" name="cost" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">attach_money</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="number" class="form-control money-dollar text-center" placeholder="Tarifa  Ex: 19% ó 5%" name="tariff" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Proveedor</b></p>
                                    <select class="form-control show-tick" name="provider_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($providers as $element)
                                            <option value="{{ $element->id }}">{{ $element->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Categoria</b></p>
                                    <select class="form-control show-tick" name="category">
                                        <option value="">Selecione...</option>
                                        <option value="papeleria">Papeleria</option>
                                        <option value="aseo">Aseo</option>
                                        <option value="cafeteria">Cafeteria</option>
                                        <option value="activosfijos">Activos Fijos</option>
                                        <option value="otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="description" cols="30" rows="2" class="form-control no-resize" required></textarea>
                                            <label class="form-label">Description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="file-field">
                                    <div class="btn btn-primary btn-sm float-left">
                                        <span>Adiciona Imagen</span>
                                        <input type="file" name="imagen" accept=".pdf,.jpg,.png" >
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">GUARDAR</button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
@endsection

@section('footer-scripts')

@endsection