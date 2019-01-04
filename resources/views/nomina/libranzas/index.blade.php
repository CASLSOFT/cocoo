@extends('layouts.nomina')

@section('title')
    Crear Libranzas
@endsection

@section('page-header')
    
@endsection
@section('page-content')
<div class="col-lg-10">
    <div class="card">
        <div class="header text-white bg-green">
            <font>
                <h4>Crear Libranza</h4>
            </font>
        </div>
        <!-- /.panel-heading -->
        <div class="body">
            <div class="row">
                <div class="col-md-6">
                    <vue-autocomplete @itemselect="showEmployee"></vue-autocomplete>
                </div>
                <div class="col-md-6">                    
                    <label v-text="items.identificacion"> </label>                
                    <label v-text="items.firstname"></label>
                    <label v-text="items.lastname"></label>                
                    <br>
                    <label v-text="items.email"></label>
                    <br>
                    <label v-text="items.CO"></label>
                </div>
            </div>
            <div class="row">
                <form @submit.prevent="create()" 
                        @keydown="form.errors.clear($event.target.name)" 
                        @Change="form.errors.clear($event.target.name)">
                    <div class="row">                        
                        <div class="col-md-3">
                            <p><b># Cuota Mensual</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="cuota_mensual" class="form-control text-center" v-model="form.cuota_mensual">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('cuota_mensual')" v-text="form.errors.get('cuota_mensual')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><b># Cuota Quincenal</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="cuota_quincenal" class="form-control text-center" v-model="form.cuota_quincenal">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('cuota_quincenal')" v-text="form.errors.get('cuota_quincenal')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><b># Cuota De:</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="cuota_de" class="form-control text-center" v-model="form.cuota_de">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('cuota_de')" v-text="form.errors.get('cuota_de')"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><b># Cuota Hasta</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="numeric" name="cuota_hasta" class="form-control text-center" v-model="form.cuota_hasta">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('cuota_hasta')" v-text="form.errors.get('cuota_hasta')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Entidad Recaudadora</b></p>
                            <div class="input-group input-group-lg">
                                <div class="form-line">
                                    <input type="text" name="entidad" class="form-control text-center" v-model="form.entidad">
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('entidad')" v-text="form.errors.get('entidad')"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><b>Categoria</b></p>
                            <select class="form-control" v-model="form.category" name="category">
                                {{-- <option value="">Seleccione</option> --}}
                                <option value="LIBRANZA">Libranza</option>
                                <option value="DESCUENTO">Descuento Voluntario</option>
                                <option value="EMBARGO">Embargo</option>
                            </select>
                            <span  class="label label-danger" v-if="form.errors.has('category')" v-text="form.errors.get('category')"></span>
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

@endsection

@section('footer-scripts')

<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
        data: {
            items: {},
            form: new Form({
                employee_id: '',
                cuota_mensual:'',
                cuota_quincenal:'',
                cuota_de:'',
                cuota_hasta:'',
                entidad:'',
                category:''
            }) 
        },
        mounted() {
            
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
                this.form.submit('post','/nomina/libranza')
                .then(response => toastr.success('Creada con exito!', 'Libranza'))
                .catch(error => this.form.errors.record(error.errors));
                this.items = {};
            }
        }
    });
    
</script>
@endsection