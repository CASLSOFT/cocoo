@extends('layouts.nomina')

@section('title')
    Empleado
@endsection

@section('page-header')
    Información Seguridad Social
@endsection

@section('page-content')
    <div class="row clearfix">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <div class="card">
                <div class="header">
                    <h2>
                        CREAR EMPLEADO
                    </h2>                    
                </div>
                <div class="body">
                    <form @submit.prevent="create()" 
                        @keydown="form.errors.clear($event.target.name)" 
                        @Change="form.errors.clear($event.target.name)">
                        <div class="row">

                            
                            <div class="col-md-4" >                                
                                <label class="control-label">Tipo Identificación</label>
                                <div style="font-size: 12px; padding-left: 25px;">
                                    <input name="group1" type="radio" id="radio_9" class="with-gap radio-col-purple" v-model="form.typecc" value="CC">
                                    <label for="radio_9">CC</label>                                
                                    <input name="group1" type="radio" id="radio_14" class="with-gap radio-col-cyan" v-model="form.typecc" value="TI">
                                    <label for="radio_14">TI</label>                                
                                    <input name="group1" type="radio" id="radio_18" class="with-gap radio-col-lime" v-model="form.typecc" value="Otro">
                                    <label for="radio_18">Otro</label>
                                </div>                                
                                <span  class="label label-danger" v-if="form.errors.has('typecc')" v-text="form.errors.get('typecc')"></span>                                
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Area</label>
                                <div>
                                    <input name="group5" type="radio" id="radio_1" class="with-gap radio-col-orange" v-model="form.area" value="administracion">
                                    <label for="radio_1">Administracion</label>                                
                                    <input name="group5" type="radio" id="radio_2" class="with-gap radio-col-teal" v-model="form.area" value="comercial">
                                    <label for="radio_2">Comercial</label>                                
                                    <input name="group5" type="radio" id="radio_3" class="with-gap radio-col-red" v-model="form.area" value="farmacia">
                                    <label for="radio_3">Farmacia</label>
                                </div>
                                <span  class="label label-danger" v-if="form.errors.has('area')" v-text="form.errors.get('area')"></span>
                            </div>
                            <div class="col-md-4">
                                <label ># Identificacion</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="identificacion" class="form-control" v-model="form.identificacion">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('identificacion')" v-text="form.errors.get('identificacion')"></span>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label >Nombres</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="firstname" class="form-control" v-model="form.firstname">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></span>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <label >Apellidos</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input name="lastname" class="form-control" v-model="form.lastname">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></span>
                                </div>                            
                            </div>                            
                        </div>                        
                        <div class="row">                            
                            <div class="col-md-5"> 
                                <label for="email_address">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="email" class="form-control" v-model="form.email">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Centro de Operación</label>
                                <select class="form-control show-tick" name="CO" v-model="form.CO">
                                    <option value="">-- Please select --</option>
                                    <option value="001">OFICINA PRINCIPAL</option>
                                    <option value="016">FARMACIA PUEBLO NUEVO</option>
                                    <option value="017">FARMACIA VALENCIA</option>
                                    <option value="018">FARMACIA LORICA</option>
                                    <option value="024">FARMACIA MONTELIBANO</option>
                                    <option value="026">FARMACIA AMPAROS</option>
                                </select>
                                <span  class="label label-danger" v-if="form.errors.has('CO')" v-text="form.errors.get('CO')"></span>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Tipo Nomina</label>
                                 <select class="form-control show-tick" name="type_nomina" v-model="form.type_nomina">
                                    <option value="">Seleccione</option>
                                    <option value="P">Oficina Principal</option>
                                    <option value="F">Farmacias</option>
                                    <option value="T">Todos</option>
                                </select>                                
                                <span  class="label label-danger" v-if="form.errors.has('type_nomina')" v-text="form.errors.get('type_nomina')"></span>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-md-4">
                                <b>Fecha Ingreso</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" placeholder="Ex: AAAA/MM/DD" name="admissiondate" v-model="form.admissiondate">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('admissiondate')" v-text="form.errors.get('admissiondate')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <b>Fecha Salida</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" placeholder="Ex: AAAA/MM/DD" name="retirementdate" v-model="form.retirementdate">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('retirementdate')" v-text="form.errors.get('retirementdate')"></span>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <b>Salario</b>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" name="salary" v-model="form.salary">
                                    </div>
                                    <span  class="label label-danger" v-if="form.errors.has('salary')" v-text="form.errors.get('salary')"></span>
                                    <span class="input-group-addon" >.00</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Guardar</button>
                    </form>
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
                typecc:'',
                identificacion:'',
                firstname:'',
                lastname:'',
                email:'',
                area:'',
                CO:'',
                type_nomina:'',
                admissiondate:'',
                retirementdate:'',
                salary:''
            })            
        },
        methods: {
            create(datos) {
                
                this.form.submit('post','/employee')
                .then(response => toastr.success('Creado con exito!', 'Empleado'))
                .catch(error => this.form.errors.record(error.errors));
            }
        }
    });


</script>
@endsection