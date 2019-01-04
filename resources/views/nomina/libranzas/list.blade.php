@extends('layouts.nomina')

@section('title')
    Consulta Empleados
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-md-9">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="col-md-6">
                Lista de Libranzas
            </div>
            <div style="text-align: right">
                <button @click="getInactivas" type="button" class="btn bg-teal waves-effect">Inactivas</button>
                <button @click="getLibranzas" type="button" class="btn bg-teal waves-effect">Activas</button>
                <button @click="getAmortizar" type="button" class="btn bg-teal waves-effect">Amortizar</button>                
          </div>
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
                            <th>Cuota Mensual</th>
                            <th>Cuota Quincenal</th>
                            <th>De</th>
                            <th>Hasta</th>
                            <th>Entidad</th>
                            <th>Categoria</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in libranzas.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.co"></td>
                            <td>@{{ item.firstname }} @{{ item.lastname }}</td>
                            <td v-text="item.cuota_mensual" style="text-align: right"></td>
                            <td v-text="item.cuota_quincenal" style="text-align: right"></td>
                            <td v-text="item.cuota_de" style="text-align: right"></td>
                            <td v-text="item.cuota_hasta" style="text-align: right"></td>
                            <td v-text="item.entidad"></td>
                            <td v-text="item.category"></td>
                            <td>
                                {{-- <a href="#" :class="item.status == 1 ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-remove'" 
                                @click="getActive(item.id)" alt="Activar o Inactivar Usuario"></a> --}}
                                <a href="#" @click="getActive(item.id)" alt="Activar o Inactivar Usuario">
                                    <i v-if="item.state" class="material-icons">check</i>
                                    <i v-else class="material-icons">remove_circle_outline</i>
                                </a>
                                <a href="#" @click.prevent="getEdit(item)" data-target="#Modal"><i class="material-icons">edit</i></a>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <vue-pagination  :pagination="libranzas" @paginate="getLibranzas()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<div class="col-md-3">
    <h4>Ultimas Amortizaciones</h4>
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action" v-for="item in amortizaciones" >@{{ item.fecha_inic }} Hasta @{{ item.fecha_final }}</a>      
    </div>
</div>

<!-- Modal -->

@include('nomina.libranzas.edit')
@include('nomina.libranzas.amortizar')

@endsection

@section('footer-scripts')

<script type="text/javascript">


    var vm = new Vue({
        el: '#main',
        data: {
            status:1,
            fillLibranza: new Form({
                id: '',
                cuota_mensual:'',
                cuota_quincenal:'',
                cuota_de:'',
                cuota_hasta:'',
                entidad:'',
                category:''
            }),
            libranzas: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            amortizaciones: {},
            offset: 4,
            amortizacion: new Form({
                fecha_inic: '',
                fecha_final: '',
                message:''
            })
        },
        mounted() {
            this.getLibranzas();
            this.getAmortizaciones();
        },
        methods: {
            getInactivas(){
                let url = '/nomina/libranzas/list/0?page='+this.libranzas.current_page;
                axios.get(url).then(response => {                        
                        this.libranzas = response.data;
                    });
            },
            getLibranzas() {
                let url = '/nomina/libranzas/list/1?page='+this.libranzas.current_page;
                axios.get(url).then(response => {                        
                        this.libranzas = response.data;
                    });
            },
            getAmortizaciones(){
                let url = '/nomina/libranzas/amortizaciones';
                axios.get(url).then(response => {                        
                        this.amortizaciones = response.data;
                    });
            },
            getActive(id) {
                let url = '/nomina/libranzas/'+id;
                axios.put(url).then(response => {
                        this.getLibranzas();              
                    });   
            },
            getEdit(item) {
                this.fillLibranza.id = item.id;
                this.fillLibranza.cuota_mensual = item.cuota_mensual;
                this.fillLibranza.cuota_quincenal = item.cuota_quincenal;
                this.fillLibranza.cuota_de = item.cuota_de;
                this.fillLibranza.cuota_hasta = item.cuota_hasta;
                this.fillLibranza.entidad = item.entidad;
                this.fillLibranza.category = item.category;                

                $('#edit').modal('show');
            },
            updateLibranza(id) {
                let url = '/nomina/libranza/'+id;
                this.fillLibranza.submit('put',url)
                .then(response => {                    
                    this.fillLibranza;
                    $('#edit').modal('hide');
                    toastr.success('Actualizada', 'Libranza');
                    this.getLibranzas();
                })
                .catch(error => this.fillLibranza.errors.record(error.response.data));
            },
            getAmortizar() {
                $('#amortizarLibranza').modal('show');
            },
            amortizarLibranza() {

                if (this.amortizacion.fecha_final <= this.amortizacion.fecha_inic ) {
                    toastr.error('Error en Fechas', 'Libranza');
                } else {
                    let url = "/nomina/libranzas/amortizar";
                    this.amortizacion.submit('post', url)
                    .then(response => {
                        $('#amortizarLibranza').modal('hide');
                        toastr.success('Amortización realizada', 'Libranza');
                        this.getLibranzas();
                        this.getAmortizaciones();
                    })
                    .catch(error => {
                        if (error.message) {
                            toastr.error(error.message, 'Libranza');
                        } else {
                            this.amortizacion.errors.record(error.response.data);
                        }
                    });                    
                }
            }
        }
    });
    
</script>
@endsection