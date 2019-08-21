@extends('layouts.requisiciones')

@section('title')
    Proveedores
@endsection

@section('page-header')
    Creacion de Centros de Operación
@endsection

@section('page-content')
    {{-- @can('provider.store') --}}
    <div class="container-fluid">
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CREACION DE PROVEEDORES
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
                                    @can('article.create')
                                    <li><a href="{{ route('article.create') }}">Crear Articulo</a></li>
                                    @endcan
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        @can('provider.create')
                        <div class="row">
                            <form action="{{ route('provider.store') }}"
                            @submit.prevent="create()"
                            @keydown="form.errors.clear($event.target.name)">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required v-model="form.nit">
                                            <label class="form-label">NIT</label>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('nit')" v-text="form.errors.get('nit')"></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required v-model="form.name">
                                            <label class="form-label">Nombre</label>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="payment" required v-model="form.payment">
                                            <label class="form-label">Forma de Pago</label>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('payment')" v-text="form.errors.get('payment')"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="ment" required v-model="form.ment">
                                            <label class="form-label">Plazo</label>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('ment')" v-text="form.errors.get('ment')"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit" :disabled="form.errors.any()">GUARDAR</button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
    @can('provider.list')
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Forma de Pago</th>
                                        <th>Plazo</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(provider, index) in providers.data">
                                        <template v-if="! provider.editing">
                                            <td v-text="index+1"></td>
                                            <td v-text="provider.nit"></td>
                                            <td v-text="provider.name"></td>
                                            <td v-text="provider.payment"></td>
                                            <td v-text="provider.ment"></td>
                                            <td>
                                                @can('provider.edit')
                                                <a href="#" @click.prevent="editSalida(provider)"><i class="material-icons">edit</i></a>
                                                @endcan
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td v-text="index+1"></td>
                                            <td><input type="text" v-model="draft.nit" ></td>
                                            <td><input type="text" v-model="draft.name" ></td>
                                            <td><input type="text" v-model="draft.payment" ></td>
                                            <td><input type="text" v-model="draft.ment" ></td>
                                            <td>
                                                <a href="#" @click.prevent="updateSalida(provider, draft)"><i class="material-icons">check</i></a>
                                                <a href="#" @click.prevent="cancel(provider)"><i class="material-icons">cancel</i></a>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                            <vue-pagination  :pagination="providers" @paginate="getProviders()" :offset="2"></vue-pagination>
                        </div>
                    </div>
                    {{-- pagination --}}
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('footer-scripts')
    <script type="text/javascript">

        var vm = new Vue({
            el: '#main',
            mounted() {
                this.getProviders();
            },
            data: {
                form: new Form({
                    nit:'',
                    name:'',
                    payment:'',
                    ment:''
                }),
                DATO: [],
                errorsEdit: [],
                errorsStore: [],
                draft: {},
                fillDraft: new Form({
                    id: '',
                    nit:'',
                    name:'',
                    payment:'',
                    ment:''
                }),
                providers: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                offset: 3,
            },
            methods: {
                getProviders(){
                    let url = '/requisiciones/provider?page='+this.providers.current_page;
                    axios.get(url).then(response => this.providers = response.data);
                },
                create(datos) {
                    this.form.submit('post','/requisiciones/provider')
                    .then(response => toastr.success('Creado con exito!', 'Proveedor'))
                    .catch(error => this.form.errors.record(error.errors));
                    this.getProviders();
                },
                deleteSalida: function (salida) {
                    this.errorsEdit = [];
                    this.errorsStore = [];
                    var url = '/provider/' + salida.id;
                    axios.delete(url).then(response => {
                        this.getDestination();
                        toastr.success('Eliminado correctamente')
                    });
                },
                editSalida(salida) {
                    this.fillDraft.id = salida.id;
                    this.fillDraft.nit = salida.nit;
                    this.fillDraft.name = salida.name;
                    this.fillDraft.payment = salida.payment;
                    this.fillDraft.ment = salida.ment;
                    this.draft = $.extend({}, salida);
                    Vue.set(salida, 'editing', true);
                },
                cancel: function(salida){
                    salida.editing = false;
                },
                updateSalida: function (salida, draft) {
                    var url = '/requisiciones/provider/' + draft.id;
                    axios.put(url, {
                        nit: draft.nit,
                        name: draft.name,
                        payment: draft.payment,
                        ment: draft.ment,
                        id: draft.id
                    })
                    .then(response => {
                        toastr.success('Actualizado', 'Proveedor');
                        this.getProviders();
                    })
                    .catch(e => toastr.error('Error al editar los articulos. '));

                },
                changePage: function(page) {
                  this.pagination.current_page = page;
                  this.getEntradas(page);
                }
            }
        });
    </script>
@endsection