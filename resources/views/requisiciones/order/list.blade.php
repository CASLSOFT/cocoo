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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            MIS ORDENES
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    @can('order.draftsuser')
                                    <li><a href="{{ url('requisiciones/drafts') }}" class="waves-effect waves-block">Ordenes Borrador</a></li>
                                    @endcan
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                    {{-- <li><a href="{{ route('article.create') }}">Crear Articulo</a></li> --}}
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable ">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th>Observaciones</th>
                                        <th>Fecha Aprobación</th>
                                        <th>Fecha Recibido</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th>Observaciones</th>
                                        <th>Fecha Aprobación</th>
                                        <th>Fecha Recibido</th>
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

    @if (@isset ($order))
        @foreach ($order as $element)
            {{ $element->status }}
        @endforeach
    @endif
@endsection

@section('footer-scripts')
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script>
        $(function(){
            $('.js-exportable').DataTable({
                serverSide: true,
                 ajax: '{{ url('/requisiciones/ordersxuser/list') }}',
                dom: 'Bfrtip',
                responsive: true,
                processing: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                columns:[
                    {data: 'category'},
                    {data: 'status'},
                    {data: 'observations'},
                    {data: 'dateapproval'},
                    {data: 'datereceived'},
                    // {data: 'imagen'},
                    {data: 'btn'}
                ],
                language: {
                    "decimal":        "",
                    "emptyTable":     "No hay datos disponibles en la tabla",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 to 0 de 0 registros",
                    "infoFiltered":   "(Filtrado de _MAX_ total registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Ver _MENU_ registros",
                    "loadingRecords": "Loading...",
                    "processing":     "Processing...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No matching records found",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });
    </script>
@endsection