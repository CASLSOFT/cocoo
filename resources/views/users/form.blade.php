@extends('layouts.admin')

@section('title')
    Perfil
@endsection

{{-- @section('page-header')
    Crear Usuario
@endsection --}}
@section('page-content')
<div id="form-user">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#CD5DDD;">
                        <font color="white">
                            <h4 class="title">Adicionar Usario</h4>
                            {{-- <p class="category">Complete your profile</p> --}}
                        </font>
                    </div>
                    <div class="panel-body">
                        <form @submit.prevent="createUser()" @keydown="form.errors.clear($event.target.name)">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nombres</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control input-sm" v-model='form.firstname'>
                                        <span  class="label label-danger" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Apellidos</label>
                                        <input type="text" id="lastname" name="lastname" class="form-control input-sm" v-model='form.lastname'>
                                        <span  class="label label-danger" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control input-sm" v-model='form.email'>
                                        <span  class="label label-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control input-sm" v-model='form.username'>
                                        <span  class="label label-danger" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Area</label>
                                         <select class="form-control input-sm" v-model='form.area' @Change="form.errors.clear('area')">
                                            <option>Seleccione</option>
                                            <option value="administracion">Administracion</option>
                                            <option value="comercial">Comercial</option>
                                            <option value="farmacia">Farmacia</option>
                                        </select>
                                        <span  class="label label-danger" v-if="form.errors.has('area')" v-text="form.errors.get('area')"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Estado</label>
                                        <div class="form-group">
                                            <label class="radio-inline"><input type="radio" value="0" v-model="form.state" @click="form.errors.clear('state')">Inactivo</label>
                                            <label class="radio-inline"><input type="radio" value="1" v-model="form.state" @click="form.errors.clear('state')">Activo</label>
                                            <span  class="label label-danger" v-if="form.errors.has('state')" v-text="form.errors.get('state')"></span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>                            
                            <button class="btn btn-primary pull-right" :disabled="form.errors.any()">Guardar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
    
</div>
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