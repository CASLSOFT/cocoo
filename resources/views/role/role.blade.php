@extends('layouts.AdminBSB')

@section('title')
    Roles
@endsection

@section('page-header')
    Creacion de Roles
@endsection

@section('page-content')
    <div class="row clearfix" >
        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Creación de Roles</h2>
                </div>
                <div class="body">
                <form @submit.prevent="create()"
                      @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-3">
                            <label >Nombre</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="name" class="form-control" v-model="form.name">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Slug</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="slug" class="form-control" v-model="form.slug">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('slug')" v-text="form.errors.get('slug')"></span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label >Grupo</label>
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
        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th>Grupo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(role, index) in roles.data">
                                    <template v-if="! role.editing">
                                        <td v-text="index+1"></td>
                                        <td v-text="role.name"></td>
                                        <td v-text="role.slug"></td>
                                        <td v-text="role.description"></td>
                                        <td>
                                            <a href="#" @click.prevent="editRole(role)"><i class="material-icons">edit</i></a>
                                            <a href="#" @click.prevent="deleteRole(role)"><i class="material-icons">delete</i></a>
                                        </td>
                                    </template>
                                    <template v-else>
                                        <td v-text="index+1"></td>
                                        <td><input type="text" v-model="draft.name" class="form-control"></td>
                                        <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
                                            <li v-for="error of errorsEdit">@{{error.name[0]}}</li>
                                        </ul>
                                        <td><input type="text" v-model="draft.slug" class="form-control"></td>
                                        <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
                                            <li v-for="error of errorsEdit">@{{error.slug[0]}}</li>
                                        </ul>
                                        <td><input type="text" v-model="draft.description" class="form-control"></td>
                                        <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
                                            <li v-for="error of errorsEdit">@{{error.description[0]}}</li>
                                        </ul>
                                        </td>
                                        <td>
                                            <a href="#" @click.prevent="updateRole(role, draft)"><i class="material-icons">check</i></a>
                                            <a href="#" @click.prevent="cancel(role)"><i class="material-icons">cancel</i></a>
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                        <vue-pagination  :pagination="roles" @paginate="getRoles()" :offset="2"></vue-pagination>
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
                this.getRoles();
            },
            data: {
                form: new Form({
                    name:'',
                    slug:'',
                    description:''
                }),
                DATO: [],
                errorsEdit: [],
                errorsStore: [],
                draft: {},
                fillDraft: new Form({
                    id: '',
                    name:'',
                    slug:'',
                    description:''
                }),
                roles: {
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
                getRoles(){
                    let url = 'role/list/?page='+this.roles.current_page;
                    axios.get(url).then(response => this.roles = response.data);
                },
                create(datos) {
                    this.form.submit('post','/role')
                    .then(response => {
                        toastr.success('Creado con exito!', 'Role');
                        this.getRoles();
                    })
                    .catch(error => this.form.errors.record(error.errors));
                },
                deleteRole: function (salida) {
                    this.errorsEdit = [];
                    this.errorsStore = [];
                    var url = '/role/' + salida.id;
                    axios.delete(url).then(response => {
                        this.getRoles();
                        toastr.success('Eliminado correctamente')
                    });
                },
                editRole(salida) {
                    this.fillDraft.id = salida.id;
                    this.fillDraft.name = salida.name;
                    this.fillDraft.slug = salida.slug;
                    this.fillDraft.description = salida.description;
                    this.draft = $.extend({}, salida);
                    Vue.set(salida, 'editing', true);
                },
                cancel: function(salida){
                    salida.editing = false;
                },
                updateRole: function (salida, draft) {
                    var url = '/role/' + draft.id;
                    axios.put(url, {
                        name: draft.name,
                        slug: draft.slug,
                        description: draft.description,
                        id: draft.id
                    })
                    .then(response => {
                        toastr.success('Actualizado', 'Role');
                        this.getRoles();
                    })
                    .catch(error => this.fillEmployee.errors.record(error.response.data));
                },
                changePage: function(page) {
                  this.pagination.current_page = page;
                  this.getEntradas(page);
                }
            }
        });
    </script>
@endsection