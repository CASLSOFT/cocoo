@extends('layouts.nomina')

@section('title')
    TNL
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-10">
    <div class="card">
        <div class="header text-white bg-green">
            <font>
                <h3>Tiempos No Laborados</h3>
            </font>            
        </div>
        <!-- /.panel-heading -->
        <div class="body">
            <div class="row">
                <div class="col-md-6">
                    <vue-autocomplete @itemselect="showEmployee"></vue-autocomplete>
                </div>
                <div class="col-md-6">
                    <div v-if="items.identificacion">
                        <label v-text="items.identificacion"> </label>                
                        <label v-text="items.firstname"></label>
                        <label v-text="items.lastname"></label>                
                        <br>
                        <label v-text="items.email"></label>
                        <br>
                        <label v-text="items.CO"></label>                        
                    </div>
                    <div v-else>
                        <span  class="label label-danger" v-if="form.errors.has('employee_id')" v-text="form.errors.get('employee_id')"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <form @submit.prevent="create()"
                        @keydown="form.errors.clear($event.target.name)" 
                        @Change="form.errors.clear($event.target.name)">
                    <div class="row">                    
                        <div class="col-md-3">
                            <p><b>Fecha Inicial: </b></p>
                            <div class="form-group">
                                <div class="form-line"> 
                                    <input id="since" type="date" name="since" class="form-control" v-model="form.since">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('since')" v-text="form.errors.get('since')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><b>Fecha Final: </b></p>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="until" type="date" name="until" class="form-control" v-model="form.until" 
                                    @Change="calculardays">                                    
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('until')" v-text="form.errors.get('until')"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p><b>Tipo de TNL</b></label>
                            <div class="form-group label-floating">
                                {{-- crear una tabla con estos campos --}}
                                <select class="form-control" v-model="form.typeTNL" name="typeTNL">
                                    <option>Seleccione</option>
                                    <option value="EG">Enfermedad General</option>
                                    <option value="LM">Licencia Maternidad</option>
                                    <option value="LP">Licencia Paternidad</option>
                                    <option value="LL">Ley de Luto</option>
                                    <option value="SUP">Suspensión</option>
                                    <option value="PNR">Permiso No Remunerado</option>
                                </select>
                            </div>
                        </div>
                        <span  class="label label-danger" v-if="form.errors.has('typeTNL')" v-text="form.errors.get('typeTNL')"></span>
                        <div class="col-md-2">
                            <p><b># de Días</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="days" class="form-control" v-model="form.days" disabled="true" style="text-align: center">
                                        <span  class="label label-danger" v-if="form.errors.has('days')" v-text="form.errors.get('days')"></span>
                                </div>
                            </div>
                        </div>
                    </div>                                                   
                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>                
                    <div class="clearfix"></div>
                </form>
            </div>    
        </div>
        <!-- /.panel-body -->        
    </div>
    <!-- /.panel -->
</div>

{{-- Tabla --}}
<div class="col-lg-10">
    <div class="panel panel-info">
        <div class="panel-heading">
            Listado de TNL
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CO</th>
                            <th>Empleado</th>
                            <th style="text-align: center">Desde</th>
                            <th style="text-align: center">Hasta</th>
                            <th style="text-align: center">TNL</th>
                            <th style="text-align: center">Días Disfrutados</th>                            
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in TNLs.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.co"></td>
                            <td v-text="item.firstname + item.lastname"></td>
                            <td v-text="item.since" style="text-align: center"></td>
                            <td v-text="item.until" style="text-align: center"></td>
                            <td v-text="item.typeTNL" style="text-align: center"></td>
                            <td v-text="item.days" style="text-align: center"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="material-icons">edit</i></a>
                                <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="TNLs" @paginate="getHolidays()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('nomina.novelty.tnls.edit')

@endsection

@section('footer-scripts')
<script src="{{ asset('js/moment.js') }}"></script>

<script type="text/javascript">
    
    var vm = new Vue({
        el: '#main',
        data: {
            items: {},
            form: new Form({
                employee_id: '',
                since:'',
                until:'',
                days:'',
                typeTNL: ''
            }),
            status:1,
            fillTNL: new Form({
                id: '',
                since:'',
                until:'',
                days:'',
                typeTNL: ''
            }),
            TNLs: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4 
        },
        mounted() {
            this.getTNLs();
        },        
        methods: {
            showEmployee(id){                
                this.form.employee_id = id;
                axios.get('/employee/' + id)
                  .then(response => {
                  this.items = response.data;                  
                });
            },
            calculardays() {
                let fecha1 = moment(this.form.since);
                let fecha2 = moment(this.form.until);

                this.form.days = fecha2.diff(fecha1, 'days') + 1;
            },
            create(datos) {
                this.form.submit('post','/nomina/tnl')
                .then(response => {
                    toastr.success('Creado con exito!', 'TNL');
                    this.getTNLs();
                })
                .catch(error => this.form.errors.record(error.errors));
                this.items = {};
            },
            getTNLs() {
                let url = '/nomina/tnls/list?page='+this.TNLs.current_page;
                axios.get(url).then(response => {                        
                        this.TNLs = response.data;
                    });
            },            
            getEdit(item) {
                this.fillTNL.id = item.id;
                this.fillTNL.since = item.since;
                this.fillTNL.until = item.until;
                this.fillTNL.days = item.days;
                this.fillTNL.typeTNL = item.typeTNL;

                $('#edit').modal('show');
            },
            updateTNLs(id) {
                let url = '/nomina/tnl/'+id;
                this.fillTNL.submit('put',url)
                .then(response => {                    
                    this.fillTNL;
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'TNL');
                    this.getTNLs();
                })
                .catch(error => this.fillTNL.errors.record(error.errors));
            },
            getDelete(id) {
                let url = '/nomina/tnl/'+id;
                axios.delete(url).then(response => {
                        this.getTNLs();
                        toastr.warning('Eliminado', 'TNL');
                    });
            },
        }
    });
    
</script>
@endsection