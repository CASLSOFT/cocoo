@extends('layouts.nomina')

@section('title')
    Tabla Amortización
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-10">
    <div class="card">
        <div class="header bg-green">
            <font color="white">
                <h4>Tabla de Amortizacion Por Empleado</h4>
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
        </div>
        <!-- /.panel-body -->        
    </div>
    <!-- /.panel -->

</div>

{{-- Tabla --}}
<div class="col-lg-10">
    <div class="panel panel-info">
        <div class="panel-heading" style="height: 80px;">
            <div class="col-md-9" >
                Tabla de Amortización                
            </div>
            <div class="col-md-3">
                <p><b>Filtrar Por Categoria</b></p>
                <select class="form-control" name="category" @change="filterxcategory" v-model="category">
                    <option value="">Seleccione</option>
                    <option value="LIBRANZA">Libranza</option>
                    <option value="DESCUENTO">Descuento Voluntario</option>
                    <option value="EMBARGO">Embargo</option>
                </select>                
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>                            
                            <th rowspan="2" width="20%">Entidad</th>                            
                            <th style="text-align: center" style="text-align: center" colspan="2" width="20%">Monto Cuotas</th>
                            <th style="text-align: center" style="text-align: center" colspan="2" width="20%"># Cuotas</th>
                            <th style="text-align: center" style="text-align: center" colspan="2" width="20%">Periodos</th>
                            <th style="text-align: center" style="text-align: center" rowspan="2" width="20%">Opciones</th>
                        </tr>
                        <tr>
                            <td style="text-align: center" width="15%">Mensual</td>
                            <td style="text-align: center" width="15%">Quincenal</td>
                            <td style="text-align: center" width="5%">#</td>
                            <td style="text-align: center" width="5%">De</td>
                            <td style="text-align: center" width="10%">Desde</td>
                            <td style="text-align: center"  width="10%">Hasta</td>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in amortizaciones.data">                            
                            <td v-text="index+1 + ' ' + item.entidad" width="20%"></td>
                            <td v-text="item.cuota_mensual" style="text-align: center" width="15%"></td>
                            <td v-text="item.cuota_quincenal" style="text-align: center" width="15%"></td>
                            <td v-text="item.cuota_de" style="text-align: center" width="5%"></td>
                            <td v-text="item.cuota_hasta" style="text-align: center" width="5%"></td>
                            <td v-text="item.fecha_inic" style="text-align: center" width="10%"></td>
                            <td v-text="item.fecha_final" style="text-align: center" width="10%"></td>
                            <td style="text-align: center" width="20%">
                                <a href="#" @click.prevent="getEdit(item)" data-target="#Modal"><i class="material-icons">edit</i></a>
                                <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons col-red">delete</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="amortizaciones" @paginate="getAmortizaciones()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('nomina.libranzas.editAmortizacion')

@endsection

@section('footer-scripts')
<script src="{{ asset('js/moment.js') }}"></script>

<script type="text/javascript">
    
    var vm = new Vue({
        el: '#main',
        data: {
            items: {},
            form: new Form({
                employee_id: ''
            }),
            // status:1,
            fillAmortizacion: new Form({
                id: '',
                cuota_mensual:'',
                cuota_quincenal:'',
                cuota_de:''
            }),
            amortizaciones: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            category: ""
        },       
        methods: {
            showEmployee(id){                
                this.form.employee_id = id;
                axios.get('/employee/' + id)
                  .then(response => {
                  this.items = response.data;                  
                });
                this.getAmortizaciones();
            },
            getAmortizaciones() {
                let id = this.form.employee_id;
                let category = this.form.category;

                let url = '/nomina/tbamortizacion/'+ id + '/?page=' +this.amortizaciones.current_page;
                axios.get(url).then(response => {                        
                    this.amortizaciones = response.data;
                });
            },            
            getEdit(item) {
                this.fillAmortizacion.id     = item.id;
                this.fillAmortizacion.cuota_mensual  = item.cuota_mensual;
                this.fillAmortizacion.cuota_quincenal  = item.cuota_quincenal;
                this.fillAmortizacion.cuota_de = item.cuota_de;

                $('#edit').modal('show');
            },
            updateAmortizacion(id) {
                let url = '/nomina/tbamortizacion/'+id;
                this.fillAmortizacion.submit('put',url)
                .then(response => {                    
                    this.fillAmortizacion.id     = '';
                    this.fillAmortizacion.cuota_mensual  = '';
                    this.fillAmortizacion.cuota_quincenal  = '';
                    this.fillAmortizacion.cuota_de = '';
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'Modificación a la Tabla de Amortizacón realizada');                    
                })
                .catch(error => this.fillHE.errors.record(error.errors));
            },
            getDelete(id) {
                let url = '/nomina/tbamortizacion/'+id;
                axios.delete(url).then(response => {
                        this.getAmortizaciones(this.form.employee_id);
                        toastr.warning('Eliminada', 'Cuota de la Tabla de Amortización');
                    });
            },
            filterxcategory() {
                
            }
        }
    });
    
</script>
@endsection