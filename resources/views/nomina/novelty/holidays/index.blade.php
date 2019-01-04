@extends('layouts.nomina')

@section('title')
    Nomina Vacaciones
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-10">
    <div class="card">
        <div class="header text-white bg-green">
            <font>
                <h4>Vacaciones</h4>
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
                <form @submit.prevent="create()" class="form-inline"
                        @keydown="form.errors.clear($event.target.name)" 
                        @Change="form.errors.clear($event.target.name)">
                    <div class="row">                    
                        <div class="col-md-3 ">
                            <p><b>F. Inic.: </b></p>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="since" type="date" name="since" class="form-control" v-model="form.since">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('since')" v-text="form.errors.get('since')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><b>F. Final: </b></p>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="until" type="date" name="until" class="form-control" v-model="form.until" 
                                @Change="calculardays">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('until')" v-text="form.errors.get('until')"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p><b># Días: </b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="days" class="form-control" v-model="form.days" disabled="true" style="text-align: center">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('days')" v-text="form.errors.get('days')"></span>
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
<div class="col-lg-10">
    <div class="panel panel-info">
        <div class="panel-heading">
            Listado de Vacaciones            
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
                            <th style="text-align: center">Días Disfrutados</th>                            
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in holidays.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.co"></td>
                            <td v-text="item.firstname + item.lastname"></td>
                            <td v-text="item.since" style="text-align: center"></td>
                            <td v-text="item.until" style="text-align: center"></td>
                            <td v-text="item.days" style="text-align: center"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="material-icons">edit</i></a>
                                <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="holidays" @paginate="getHolidays()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('nomina.novelty.holidays.edit')

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
                days:''
            }),
            status:1,
            fillHoliday: new Form({
                id: '',
                since:'',
                until:'',
                days:''                
            }),
            holidays: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4 
        },
        mounted() {
            this.getHolidays();
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
                this.form.submit('post','/nomina/holiday')
                .then(response => {
                    toastr.success('Adiconada con exito!', 'Vacaciones');
                    this.getHolidays();
                })
                .catch(error => this.form.errors.record(error.errors));
                this.items = {};
            },
            getHolidays() {
                let url = '/nomina/holidays/list?page='+this.holidays.current_page;
                axios.get(url).then(response => {                        
                        this.holidays = response.data;
                    });
            },            
            getEdit(item) {
                this.fillHoliday.id = item.id;
                this.fillHoliday.since = item.since;
                this.fillHoliday.until = item.until;
                this.fillHoliday.days = item.days;

                $('#edit').modal('show');
            },
            updateVacaciones(id) {
                let url = '/nomina/holiday/'+id;
                this.fillHoliday.submit('put',url)
                .then(response => {                    
                    this.fillHoliday;
                    $('#edit').modal('hide');
                    toastr.success('Actualizada', 'Vacaciones');
                    this.getHolidays();
                })
                .catch(error => this.fillHoliday.errors.record(error.errors));
            },
            getDelete(id) {
                let url = '/nomina/holiday/'+id;
                axios.delete(url).then(response => {
                        this.getHolidays();
                        toastr.warning('Eliminada', 'Vacaciones');
                    });
            },
        }
    });
    
</script>
@endsection