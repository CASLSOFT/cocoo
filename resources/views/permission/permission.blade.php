@extends('layouts.AdminBSB')

@section('title')
    Permisos
@endsection

@section('page-header')
    Creacion de Permisos
@endsection

@section('page-content')
    <div class="row clearfix" >
        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Creación de Permisos</h2>
                </div>
                <div class="body">
                <form @submit.prevent="create()"
                      @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-4">
                            <label >Nombre</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="name" class="form-control" v-model="form.name">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Slug</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="slug" class="form-control" v-model="form.slug">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('slug')" v-text="form.errors.get('slug')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                <tr v-for="(permission, index) in permissions.data">
                                    <template v-if="! permission.editing">
                                        <td v-text="index+1"></td>
                                        <td v-text="permission.name"></td>
                                        <td v-text="permission.slug"></td>
                                        <td v-text="permission.description"></td>
                                        <td>
                                            <a href="#" @click.prevent="editPermission(permission)"><i class="material-icons">edit</i></a>
                                            <a href="#" @click.prevent="deletePermission(permission)"><i class="material-icons">delete</i></a>
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
                                            <a href="#" @click.prevent="updatePermission(permission, draft)"><i class="material-icons">check</i></a>
                                            <a href="#" @click.prevent="cancel(permission)"><i class="material-icons">cancel</i></a>
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                        <vue-pagination  :pagination="permissions" @paginate="getPermissions()" :offset="2"></vue-pagination>
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
                this.getPermissions();
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
                permissions: {
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
                getPermissions(){
                    let url = 'permission/list/?page='+this.permissions.current_page;
                    axios.get(url).then(response => this.permissions = response.data);
                },
                create(datos) {
                    this.form.submit('post','/permission')
                    .then(response => {
                        toastr.success('Creado con exito!', 'Permiso');
                        this.getPermissions();
                    })
                    .catch(error => this.form.errors.record(error.errors));
                },
                deletePermission: function (salida) {
                    this.errorsEdit = [];
                    this.errorsStore = [];
                    var url = '/permission/' + salida.id;
                    axios.delete(url).then(response => {
                        this.getPermissions();
                        toastr.success('Eliminado correctamente')
                    });
                },
                editPermission(salida) {
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
                updatePermission: function (salida, draft) {
                    var url = '/permission/' + draft.id;
                    axios.put(url, {
                        name: draft.name,
                        slug: draft.slug,
                        description: draft.description,
                        id: draft.id
                    })
                    .then(response => {
                        toastr.success('Actualizado', 'Role');
                        this.getPermissions();
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