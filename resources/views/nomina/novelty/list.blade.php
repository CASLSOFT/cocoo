@extends('layouts.nomina')

@section('title')
    Novedades
@endsection

@section('page-header')
    Ingreso de Novedades
@endsection

@section('page-content')

<div class="col-lg-10">
    @can('novelty.list') {{-- validamos que el usuario tenga los permisos --}}
        <div class="panel panel-info">
            <div class="panel-heading">
                Listado de Novedades
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Tipo</th>
                                <th style="text-align: center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in noveltys.data">
                                <td v-text="index+1"></td>
                                <td v-text="item.f_initial"></td>
                                <td v-text="item.f_final"></td>
                                <td v-text="item.type_nomina"></td>
                                <td style="text-align: center">
                                    @can('novelty.edit')
                                        <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser" title="Modificar Registro">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                    @endcan
                                    @can('novelty.destroy')
                                        <a href="#" @click.prevent="getDelete(item.id)" title="Eliminar Registro"><i class="material-icons">delete</i></a>
                                    @endcan
                                    <a :href="'pdf/' + item.id" target=”_blank” title="Exportar a PDF"><i class="material-icons xs-3">picture_as_pdf</i></a>
                                    <a :href="'excel/' + item.id" title="Exportar a Excel"><i class="material-icons xs-3">file_copy</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <vue-pagination  :pagination="noveltys" @paginate="getNoveltys()" :offset="2"></vue-pagination>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>

    @endcan
    <!-- /.panel -->
</div>

{{-- MODAL para editar novedad --}}
@can('novelty.edit') {{-- validamos que el usuario tenga los permisos --}}
    @include('nomina.novelty.edit')
@endcan

@endsection

@section('footer-scripts')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>

    var vm = new Vue({
        el: '#main',
        data: {
            form: new Form({
                f_initial: '',
                f_final:'',
                type_nomina:'',
                observation:''
            }),
            fillNovelty: new Form({
                id: '',
                f_initial: '',
                f_final:'',
                type_nomina:'',
                observation:''
            }),
            noveltys: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4
        },
        mounted() {
            this.getNoveltys();
        },
        methods: {
            create(datos) {
                this.form.submit('post','/nomina/novelty')
                .then(response => {
                    toastr.success('Creado con exito!', 'Periodo');
                    this.getNoveltys();
                })
                .catch(error => {
                        if (error.message) {
                            toastr.error(error.message, 'Periodo de Novedad');
                        } else {
                            this.form.errors.record(error.errors)
                        }
                    });
            },
            getNoveltys() {
                let url = '/nomina/novelty?page='+this.noveltys.current_page;
                axios.get(url).then(response => {
                        this.noveltys = response.data;
                    });
            },
            getEdit(item) {
                this.fillNovelty.id = item.id;
                this.fillNovelty.f_initial = item.f_initial;
                this.fillNovelty.f_final = item.f_final;
                this.fillNovelty.observation = item.observation;
                this.fillNovelty.type_nomina = item.type_nomina;

                $('#edit').modal('show');
            },
            updateNovelty(id) {

                let url = '/nomina/novelty/'+id;

                axios.put(url, {
                    id: this.fillNovelty.id,
                    observation: this.fillNovelty.observation
                                }).then(res => {
                    this.fillNovelty;
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'Novedad Actualizada');
                    this.getNoveltys();
                }).catch(error => {
                    if (error.message) {
                        toastr.error(error.message, 'Periodo de Novedad');
                    } else {
                        this.form.errors.record(error.response.data)
                    }
                });
            },
            getDelete(id) {
                let url = '/nomina/novelty/'+id;
                axios.delete(url).then(response => {
                        this.getNoveltys();
                        toastr.warning('Eliminado', 'Periodo de Novedad');
                    });
            },
        }
    });
</script>
@endsection
