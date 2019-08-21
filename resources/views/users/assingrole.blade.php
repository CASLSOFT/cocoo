@extends('layouts.AdminBSB')

@section('title')
    Roles
@endsection

@section('page-header')

@endsection
@section('page-content')
<div class="col-md-7">
    {{-- @can('user.assingrole') --}}
    <div class="card">
        <div class="header text-white bg-green">
            <font>
                <h4>Asignar Roles a Usuarios</h4>
            </font>
        </div>
        <!-- /.panel-heading -->
        <div class="body">
            <div class="row">
                <div class="col-md-12">
                    <vue-searchuser @itemselect="showUser"></vue-searchuser>
                </div>
                <div class="col-md-12">
                    <div v-if="items.username" class="col-md-6">
                        <label v-text="items.username"> </label>
                    </div>
                    <div v-if="items.username" class="col-md-6">
                        <label v-text="items.firstname + ' ' + items.lastname"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <form @submit.prevent="create(items.id)" class="form-inline">
                    <div class="row">
                        <div class="col-md-10 ">
                        <div class="form-group">
                            <select class="form-control" v-model="slugrole">
                              <option value="" >Selecione Permiso</option>
                              <option v-for="item in roles.data" v-text="item.name" :value="item.slug"></option>
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
    {{-- @endcan --}}
    <!-- /.panel -->
</div>

{{-- Tabla --}}
<div class="col-lg-7">
    <div class="panel panel-info">
        <div class="panel-heading">
            Roles Asignados al Usuario
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr v-for="(item, index) in rolexuser">
                            <td v-text="index+1"></td>
                            <td v-text="item.slug"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getDelete(item.slug)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <vue-pagination  :pagination="rolexuser" @paginate="getPermissionRole()" :offset="2" ></vue-pagination> --}}
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

@endsection

@section('footer-scripts')

<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
        data: {
            items: {},
            roles: {},
            slugrole: '',
            rolexuser: {},
        },
        mounted() {
            this.listRole();
        },
        methods: {
            showUser(id){
                axios.get('/user/' + id).then(response => this.items = response.data);
                 this.getRoleUser(id);
            },
            listRole(){
                axios.get('/role/list').then(response => this.roles = response.data);
            },
            create(id) {
                axios.post('/assingrole/' + id + '/' + this.slugrole)
                .then(response => {
                    toastr.success('Adiconada con exito!', 'Permiso');
                    this.getRoleUser(id);
                    this.slugrole = "";
                });

            },
            getRoleUser(id) {
                let url = '/rolexuser/'+ id;
                axios.get(url).then(response => this.rolexuser = response.data);
            },
            getDelete(slugrole) {
                let url = '/destroyrole/'+ this.items.id + '/' + slugrole;
                axios.delete(url).then(response => {
                        this.getRoleUser(this.items.id);
                        toastr.warning('Eliminado', 'Permiso seleccionado');
                    });
            },
        }
    });

</script>
@endsection