@extends('layouts.requisiciones')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ORDENES EN DESPACHO
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    @can('order.draft')
                                    <li><a href="{{ url('requisiciones/drafts') }}" class="waves-effect waves-block">Ordenes Borrador</a></li>
                                    @endcan
                                    @can('article.create')
                                    <li><a href="{{ route('article.create') }}">Crear Articulo</a></li>
                                    @endcan
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example ">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Categoria</th>
                                        <th>Area</th>
                                        <th>Fecha Entrega Admón</th>
                                        <th>Esatdo</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Categoria</th>
                                        <th>Area</th>
                                        <th>Fecha Entrega Admón</th>
                                        <th>Esatdo</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script>
        $(function(){
            $('.js-basic-example').DataTable({
                serverSide: true,
                ajax: '{{ url('/requisiciones/despachos/list') }}',
                columns:[
                    {data: 'user.firstname'},
                    {data: 'email'},
                    {data: 'category'},
                    {data: 'user.area'},
                    {data: 'updated_at'},
                    {data: 'status'},
                    {data: 'btn'}
                ]
            });
        });
    </script>
@endsection