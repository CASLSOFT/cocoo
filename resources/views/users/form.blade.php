@extends('layouts.AdminBSB')

@section('title')
    Crear Usuario
@endsection

@section('page-content')
@can('user.create')
<div id="form-user">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#CD5DDD;">
                        <font color="white">
                            <h4 class="title">Adicionar Usario</h4>
                            {{-- <p class="category">Complete your profile</p> --}}
                        </font>
                    </div>
                    <div class="panel-body">
                        <form @submit.prevent="createUser()"
                        @keydown="form.errors.clear($event.target.name)"
                        @Change="form.errors.clear($event.target.name)">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nombres</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="firstname" name="firstname" class="form-control" v-model='form.firstname'>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Apellidos</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="lastname" name="lastname" class="form-control" v-model='form.lastname'>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Email</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" id="email" name="email" class="form-control" v-model='form.email'>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">Username</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="username" name="username" class="form-control" v-model='form.username'>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Area</label>
                                    <select class="form-control show-tick" v-model='form.area'>
                                        <option>Seleccione</option>
                                        <option value="administracion">Administracion</option>
                                        <option value="comercial">Comercial</option>
                                        <option value="farmacia">Farmacia</option>
                                    </select>
                                    <span  class="label label-danger" v-if="form.errors.has('area')" v-text="form.errors.get('area')"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Estado</label>
                                    <div >
                                        <input name="group1" type="radio" id="radio_9" class="with-gap radio-col-purple" v-model="form.state" value="0">
                                        <label for="radio_9">Inactivo</label>
                                        <input name="group1" type="radio" id="radio_14" class="with-gap radio-col-cyan" v-model="form.state" value="1">
                                        <label for="radio_14">Activo</label>
                                        <span  class="label label-danger" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary pull-right" :disabled="form.errors.any()">Guardar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection

@section('footer-scripts')

<script type="text/javascript">
//
    var vm = new Vue({
        el: '#main',
        data: {
            form: new Form({
                firstname:'',
                lastname:'',
                username:'',
                email:'',
                area:'',
                state:''
            })
        },
        methods: {
            createUser(datos) {
                this.form.submit('post','/user')
                .then(response => toastr.success('Creado con exito!', 'Usuario'))
                .catch(error => this.form.errors.record(error.response.data));
            }
        }
    });

</script>
@endsection