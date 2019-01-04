@extends('layouts.nomina')

@section('title')
    HE y Comisiones
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-10">
    <div class="card">
        <div class="header bg-green">
            <font color="white">
                <h4>Administrar HE y Comisiones</h4>
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
                        <div class="row">
                            <form @submit.prevent="create()"
                                    @keydown="form.errors.clear($event.target.name)" 
                                    @Change="form.errors.clear($event.target.name)">
                                <div class="row">                    
                                    <div class="col-md-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha HE o Mes: </label>
                                            <input id="lapso" type="date" name="lapso" class="form-control" v-model="form.lapso">
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('lapso')" v-text="form.errors.get('lapso')"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Tipo de HE o Comisión</b></p>
                                        <select class="form-control show-tick" v-model="form.typeHE" name="typeHE">
                                            <option>Seleccione</option>
                                            <option value="HED">Horas Extras Diurnas</option>
                                            <option value="HEN">Horas Extras nocturnas</option>
                                            <option value="RN">Recargo Nocturno</option>
                                            <option value="HEDD">Horas Extras Diurnas Dominical</option>
                                            <option value="HEND">Horas Extras Nocturnas Dominical</option>
                                            <option value="RDD">Recargo Diurno Dominical</option>
                                            <option value="CPV">Comision por Ventas</option>
                                            <option value="CPR">Comision por Recaudo</option>
                                        </select>
                                        <span  class="label label-danger" v-if="form.errors.has('typeHE')" v-text="form.errors.get('typeHE')"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <p><b># HE o Valor Comision</b></p>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <input type="numeric" name="value" class="form-control" v-model="form.value" style="text-align: right">
                                            </div>
                                        </div>
                                        <span  class="label label-danger" v-if="form.errors.has('value')" v-text="form.errors.get('value')"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group label-floating">
                                            <br>
                                            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- /.panel-body -->        
    </div>
    <!-- /.panel -->
    {{-- <div class="container-fluid">
    </div>
    <hr>   --}}  

</div>

{{-- Tabla --}}
<div class="col-lg-10">
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
                            <th style="text-align: center">Tipo HE/Comisión</th>
                            <th style="text-align: center"># HE/Valor C.</th>
                            <th style="text-align: center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in HEs.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.co"></td>
                            <td v-text="item.firstname + item.lastname"></td>
                            <td v-text="item.lapso" style="text-align: center"></td>
                            <td v-text="item.typeHE" style="text-align: center"></td>
                            <td v-text="item.value" style="text-align: center"></td>
                            <td style="text-align: center">
                                <a href="#" @click.prevent="getEdit(item)" data-target="#Modal"><i class="material-icons">edit</i></a>
                                <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="HEs" @paginate="getHEs()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('nomina.novelty.hes.edit')

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
                value:'',
                typeHE: ''
            }),
            status:1,
            fillHE: new Form({
                id: '',
                lapso:'',
                value:'',
                typeHE: ''
            }),
            HEs: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4 
        },
        mounted() {
            this.getHEs();
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
                this.form.submit('post','/nomina/he')
                .then(response => {
                    toastr.success('Creado con exito!', 'HE o Comisión');
                    this.form.lapso  = '';
                    this.form.value  = '';
                    this.form.typeHE = 'selected';
                    this.getHEs();
                })
                .catch(error => this.form.errors.record(error.errors));
                this.items = {};
            },
            getHEs() {
                let url = '/nomina/hes/list?page='+this.HEs.current_page;
                axios.get(url).then(response => {                        
                        this.HEs = response.data;
                    });
            },            
            getEdit(item) {
                this.fillHE.id     = item.id;
                this.fillHE.lapso  = item.lapso;
                this.fillHE.value  = item.value;
                this.fillHE.typeHE = item.typeHE;

                $('#edit').modal('show');
            },
            updateHEs(id) {
                let url = '/nomina/he/'+id;
                this.fillHE.submit('put',url)
                .then(response => {                    
                    this.fillHE.id     = '';
                    this.fillHE.lapso  = '';
                    this.fillHE.value  = '';
                    this.fillHE.typeHE = '';
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'HE o Comisión');
                    this.getHEs();
                })
                .catch(error => this.fillHE.errors.record(error.errors));
            },
            getDelete(id) {
                let url = '/nomina/he/'+id;
                axios.delete(url).then(response => {
                        this.getHEs();
                        toastr.warning('Eliminada', 'HE o Comisión');
                    });
            },
        }
    });
    
</script>
@endsection