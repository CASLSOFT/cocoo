@extends('layouts.requisiciones')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                MODIFICAR DE ARTICULOS
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        @can('article.edit')
                        <div class="row">
                            <form action="{{ route('article.update', $article) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf()
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required value="{{ $article->name }}">
                                            <label class="form-label">Nombre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="trademark" required value="{{ $article->trademark }}">
                                            <label class="form-label">Marca</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="unit" required value="{{ $article->unit }}" >
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
                                            <input type="number" class="form-control money-dollar text-center" placeholder="Costo  Ex: 9999" name="cost" required value="{{ $article->cost }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">attach_money</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="number" class="form-control money-dollar text-center" placeholder="Tarifa  Ex: 19% ó 5%" name="tariff" required value="{{ $article->tariff }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Proveedor</b></p>
                                    <select class="form-control show-tick" name="provider_id" >
                                        @foreach ($providers as $element)
                                            <option value="{{ $element->id }}">{{ $element->name }}</option>
                                        @endforeach
                                        <option value="{{ $article->provider_id }}"></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Categoria</b></p>
                                    <select class="form-control show-tick" name="category">
                                        <option value="{{ $article->category }}">{{ $article->category }}</option>
                                        <option value="Papeleria">Papeleria</option>
                                        <option value="Aseo">Aseo</option>
                                        <option value="Cafetria">Cafeteria</option>
                                        <option value="Activos Fijos">Activos Fijos</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="description" cols="30" rows="2" class="form-control no-resize" required >{{ $article->description }}</textarea>
                                            <label class="form-label">Description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="file-field">
                                    <div class="btn btn-primary btn-sm float-left">
                                        <span>Adiciona Imagen</span>
                                        <input type="file" name="imagen">
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