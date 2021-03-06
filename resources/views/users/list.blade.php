@extends('layouts.AdminBSB')

@section('title')
    Consulta Usuarios
@endsection

@section('page-header')

@endsection
@section('page-content')
<div class="col-lg-10">
    @can('user.list')
    <div class="panel panel-info">
        <div class="panel-heading">
            Lista de Usuarios
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in users.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.firstname"></td>
                            <td v-text="item.username"></td>
                            <td v-text="item.email"></td>
                            <td v-text="item.area"></td>
                            <td>
                                @can('user.active')
                                <a href="#" :class="item.state == 1 ? 'glyphicon glyphicon-thumbs-up' : 'glyphicon glyphicon-thumbs-down'" @click="getActive(item.id)" alt="Activar o Inactivar Usuario"></a>
                                @endcan
                                @can('user.edit')
                                <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="material-icons">edit</i></a>
                                @endcan
                            </td>
                        </tr>
                    </tbody>
                </table>
                <vue-pagination  :pagination="users" @paginate="getUsers()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    @endcan
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('users.edit')

@endsection

@section('footer-scripts')

<script type="text/javascript">


    var vm = new Vue({
        el: '#main',
        data: {
            fillUser: new Form({
                id: '',
                firstname:'',
                lastname:'',
                username:'',
                email:'',
                area:''
            }),
            users: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                let url = 'users/list?page='+this.users.current_page;
                axios.get(url).then(response => {
                        this.users = response.data;
                    });
            },
            getActive(id) {
                let url = 'users/'+id;
                axios.put(url).then(response => {
                        this.getUsers();
                    });
            },
            getEdit(item) {
                this.fillUser.id = item.id;
                this.fillUser.firstname = item.firstname;
                this.fillUser.lastname = item.lastname;
                this.fillUser.username = item.username;
                this.fillUser.email = item.email;
                this.fillUser.area = item.area;

                $('#edit').modal('show');
            },
            updateUser(id) {
                let url = 'user/'+id;
                this.fillUser.submit('put',url)
                .then(response => {
                    this.fillUser;
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'Usuario');
                    this.getUsers();
                })
                .catch(error => this.fillUser.errors.record(error.response.data));
            }


        }
    });

</script>
@endsection