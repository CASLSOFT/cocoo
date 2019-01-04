@extends('layouts.nomina')

@section('title')
    Retenciones
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-11">
    <div class="card">
        <div class="header bg-green">
            <font color="white">
                <h4>Administrar Retenciones en la Fuente</h4>
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
                <div class="card">
                    <div class="body">
                        <form @submit.prevent="create()"
                                @keydown="form.errors.clear($event.target.name)" 
                                @Change="form.errors.clear($event.target.name)">
                            <div class="row">                    
                                <div class="col-md-3">
                                    <p><b>Fecha Retención: </b></p>
                                    <div class="input-group input-group-md">                                        
                                        <div class="form-line">
                                            <input id="lapso" type="date" name="lapso" class="form-control" v-model="form.lapso">
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('lapso')" v-text="form.errors.get('lapso')"></span>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Ingresos: </b></p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input id="income" type="text" name="income" class="form-control" style="text-align: right" v-model="form.income">
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('income')" v-text="form.errors.get('income')"></span>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Valor Retencón: </b></p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input id="value" type="text" name="value" class="form-control" style="text-align: right" v-model="form.value">                                            
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('value')" v-text="form.errors.get('value')"></span>
                                </div>
                                <div class="col-md-2">
                                    <p><b>Procedimiento</b></p>
                                    <select class="form-control show-tick" v-model="form.process" name="process">
                                        <option>Seleccione</option>
                                        <option value="1">Opcion 1</option>
                                        <option value="2">Opcion 2</option>                                                
                                    </select>                                    
                                    <span  class="label label-danger" v-if="form.errors.has('process')" v-text="form.errors.get('process')"></span>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group label-floating">
                                        <br>
                                        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                    </div>
                                </div>
                            </div>                
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.panel-body -->        
    </div>
    <!-- /.panel -->
</div>

{{-- Tabla --}}
<div class="col-md-11">
    <div class="panel panel-info">
        <div class="panel-heading">
            Listado de Horas Extras o Comisiones
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
                            <th style="text-align: center">Lapso</th>
                            <th style="text-align: center">Ingresos</th>
                            <th style="text-align: center">Retención</th>
                            <th style="text-align: center">Procedimiento</th>
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in retentions.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.co"></td>
                            <td v-text="item.firstname + item.lastname"></td>
                            <td v-text="item.lapso" style="text-align: center"></td>
                            <td v-text="item.income" style="text-align: center"></td>
                            <td v-text="item.value" style="text-align: center"></td>
                            <td v-text="item.process" style="text-align: center"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getEdit(item)" data-target="#Modal"><i class="material-icons">edit</i></a>
                                <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="retentions" @paginate="getRetenciones()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('nomina.novelty.retentions.edit')

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
                lapso:'',
                income:'',
                value:'',
                process: ''
            }),
            status:1,
            fillRetencion: new Form({
                id: '',
                lapso:'',
                income:'',
                value:'',
                process: ''
            }),
            retentions: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4 
        },
        mounted() {
            this.getRetenciones();
        },        
        methods: {
            showEmployee(id){                
                this.form.employee_id = id;
                axios.get('/employee/' + id)
                  .then(response => {
                  this.items = response.data;                  
                });
            },
            create(datos) {
                this.form.submit('post','/nomina/retention')
                .then(response => {
                    toastr.success('Creada con exito!', 'Retención');
                    this.getRetenciones();
                })
                .catch(error => this.form.errors.record(error.errors));
                this.items = {};
            },
            getRetenciones() {
                let url = '/nomina/retentions/list?page='+this.retentions.current_page;
                axios.get(url).then(response => {                        
                        this.retentions = response.data;
                    });
            },            
            getEdit(item) {
                this.fillRetencion.id = item.id;
                this.fillRetencion.lapso = item.lapso;
                this.fillRetencion.income = item.income;
                this.fillRetencion.value = item.value;
                this.fillRetencion.process = item.process;

                $('#edit').modal('show');
            },
            updateHEs(id) {
                let url = '/nomina/retention/'+id;
                this.fillRetencion.submit('put',url)
                .then(response => {                    
                    this.fillRetencion;
                    $('#edit').modal('hide');
                    toastr.success('Actualizada', 'Retención');
                    this.getRetenciones();
                })
                .catch(error => this.fillRetencion.errors.record(error.errors));
            },
            getDelete(id) {
                let url = '/nomina/retention/'+id;
                axios.delete(url).then(response => {
                        this.getRetenciones();
                        toastr.warning('Eliminada', 'Retención');
                    });
            },
        }
    });
    
</script>
@endsection