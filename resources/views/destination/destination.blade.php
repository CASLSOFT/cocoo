@extends('layouts.AdminBSB')

@section('title')
    CO
@endsection

@section('page-header')
    Creacion de Centros de Operación
@endsection

@section('page-content')
    <div class="row clearfix" >
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="card">
                <div class="header">
                    <h2>Creación de Centro de Operación</h2>
                </div>
                <div class="body">
                <form @submit.prevent="create()"
                      @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-2">
                            <label >Codigo</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="code" class="form-control" v-model="form.code">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('code')" v-text="form.errors.get('code')"></span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <label >Descricción</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="description" class="form-control" v-model="form.description">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                            </div>
                        </div>
                        <div class="col-md-1 m-t-35">
                            <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Descricción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(destination, index) in destinations.data">
                                    <template v-if="! destination.editing">
                                        <td v-text="index+1"></td>
                                        <td v-text="destination.code"></td>
                                        <td v-text="destination.description"></td>
                                        <td>
                                            <a href="#" @click.prevent="editSalida(destination)"><i class="material-icons">edit</i></a>
                                            <a href="#" @click.prevent="deleteSalida(destination)"><i class="material-icons">delete</i></a>
                                        </td>
                                    </template>
                                    <template v-else>
                                        <td v-text="index+1"></td>
                                        <td><input type="text" v-model="draft.code" ></td>
                                        <td><input type="text" v-model="draft.description" ></td>
                                        <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
                                            <li v-for="error of errorsEdit">@{{error.description[0]}}</li>
                                        </ul>
                                        </td>
                                        <td>
                                            <a href="#" @click.prevent="updateSalida(destination, draft)"><i class="material-icons">check</i></a>
                                            <a href="#" @click.prevent="cancel(destination)"><i class="material-icons">cancel</i></a>
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                        <vue-pagination  :pagination="destinations" @paginate="getDestination()" :offset="2"></vue-pagination>
                    </div>
                </div>
                {{-- pagination --}}
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script type="text/javascript">

        var vm = new Vue({
            el: '#main',
            mounted() {
                this.getDestination();
            },
            data: {
                form: new Form({
                    code:'',
                    description:''
                }),
                DATO: [],
                errorsEdit: [],
                errorsStore: [],
                draft: {},
                fillDraft: new Form({
                    id: '',
                    code:'',
                    description:''
                }),
                destinations: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                offset: 3,
                status: 1,
            },
            methods: {
                getDestination(){
                    let url = 'destination/list/' + this.status + '?page='+this.destinations.current_page;
                    axios.get(url).then(response => this.destinations = response.data);
                },
                create(datos) {
                    this.form.submit('post','/destination')
                    .then(response => toastr.success('Creado con exito!', 'CO'))
                    .catch(error => this.form.errors.record(error.errors));
                    this.getDestination();
                },
                deleteSalida: function (salida) {
                    this.errorsEdit = [];
                    this.errorsStore = [];
                    var url = '/destination/' + salida.id;
                    axios.delete(url).then(response => {
                        this.getDestination();
                        toastr.success('Eliminado correctamente')
                    });
                },
                editSalida(salida) {
                    this.fillDraft.id = salida.id;
                    this.fillDraft.code = salida.code;
                    this.fillDraft.description = salida.description;
                    this.draft = $.extend({}, salida);
                    Vue.set(salida, 'editing', true);
                },
                cancel: function(salida){
                    salida.editing = false;
                },
                updateSalida: function (salida, draft) {
                    var url = '/destination/' + draft.id;
                    axios.put(url, {
                        code: draft.code,
                        description: draft.description,
                        id: draft.id
                    })
                    .then(response => {
                        toastr.success('Actualizado', 'CO');
                        this.getDestination();
                    })
                    .catch(error => this.fillEmployee.errors.record(error.response.data));
                },
                updateInput: function(){
                    var url = '/inventario/approveinput/';

                    axios.get(url).then(response => {
                        toastr.success('Todos los articulos fueron aprovados. ');
                        this.getEntradas()
                    }).catch(e => {
                        toastr.error('Error al aprovar los articulos. ');
                    });
                },
                changePage: function(page) {
                  this.pagination.current_page = page;
                  this.getEntradas(page);
                }
            }
        });
    </script>
@endsection