@extends('layouts.requisiciones')

@section('title')
    Permisos
@endsection

@section('page-header')

@endsection
@section('page-content')
{{-- @can('novelty.assingpermission') validamos que el usuario tenga los permisos --}}
<div class="col-md-7">
        <div class="card">
            <div class="header text-white bg-green">
                <font>
                    <h4>Asignar Permisos a Roles en Requisiciones</h4>
                </font>
            </div>
            <!-- /.panel-heading -->
            <div class="body">
                <div class="row">
                    <div class="col-md-6">
                        <vue-searchrole @itemselect="showRole"></vue-searchrole>
                    </div>
                    <div class="col-md-6">
                        <div v-if="items.name">
                            <label v-text="items.name"> </label>
                            <br>
                            <label v-text="items.description"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form @submit.prevent="create(items.id)" class="form-inline">
                        <div class="row">
                            <div class="col-md-10 ">
                            <div class="form-group">
                                <select class="form-control" v-model="slugpermissions">
                                  <option value="" >Selecione Permiso</option>
                                  <option v-for="item in permissions" v-text="item.name" :value="item.slug"></option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-1" style="float: right;">
                                <button type="submit" class="btn btn-primary pull-right fa fa-save">  Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>

    <!-- /.panel -->
</div>

{{-- Tabla --}}
<div class="col-lg-7">
    <div class="panel panel-info">
        <div class="panel-heading">
            Permisos asignados al Role
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permiso</th>
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr v-for="(item, index) in permissionsxrole.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.name"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getDelete(item.slug)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <vue-pagination  :pagination="permissionsxrole" @paginate="getPermissionRole(items.id)" :offset="2" ></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
{{-- @endcan --}}
@endsection

@section('footer-scripts')

<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
        data: {
            modulo: 'requisiciones',
            items: {},
            permissions: {},
            slugpermissions: '',
            permissionsxrole: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
        },
        mounted() {
            this.listPermission(this.modulo);
        },
        methods: {
            showRole(id){
                axios.get('/role/' + id).then(response => this.items = response.data);
                this.getPermissionRole(id);
            },
            listPermission(description){
                axios.get('/permissionxgroup/' + description).then(response => this.permissions = response.data);
            },
            create(id) {
                axios.post('/assingpermission/' + id + '/' + this.slugpermissions)
                .then(response => {
                    toastr.success('Adiconada con exito!', 'Permiso');
                    this.getPermissionRole(id);
                    this.slugpermissions = "";
                });

            },
            getPermissionRole(id) {
                let url = '/permissionxrole/'+ id + '/' + this.modulo + '?page='+this.permissionsxrole.current_page;
                axios.get(url).then(response => this.permissionsxrole = response.data);
            },
            getDelete(slugpermissions) {
                let url = '/destroypermission/'+ this.items.id + '/' + slugpermissions;
                axios.delete(url).then(response => {
                        this.getPermissionRole(this.items.id);
                        toastr.warning('Eliminado', 'Permiso seleccionado');
                    });
            },
        }
    });

</script>
@endsection