<div class="modal fabe" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Empleado</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    {{-- formulario de edición --}}
                    <form @submit.prevent="updateEmployee(fillEmployee.id)" 
                        @keydown="fillEmployee.errors.clear($event.target.name)" 
                        @Change="fillEmployee.errors.clear($event.target.name)">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Tipo Identificación</label>
                                    <div style="font-size: 12px; padding-left: 25px;">
                                    <input name="group1" type="radio" id="radio_9" class="with-gap radio-col-purple" v-model="fillEmployee.typecc" value="CC">
                                    <label for="radio_9">CC</label>                                
                                    <input name="group1" type="radio" id="radio_14" class="with-gap radio-col-cyan" v-model="fillEmployee.typecc" value="TI">
                                    <label for="radio_14">TI</label>                                
                                    <input name="group1" type="radio" id="radio_18" class="with-gap radio-col-lime" v-model="fillEmployee.typecc" value="Otro">
                                    <label for="radio_18">Otro</label>
                                </div>
                                <span  class="label label-danger" v-if="fillEmployee.errors.has('typecc')" v-text="fillEmployee.errors.get('typecc')"></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label"># Identificacion</label>
                                        <input type="text" name="identificacion" class="form-control" v-model='fillEmployee.identificacion'>
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('identificacion')" v-text="fillEmployee.errors.get('identificacion')"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nombres</label>
                                        <input type="text" name="firstname" class="form-control" v-model="fillEmployee.firstname">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('firstname')" v-text="fillEmployee.errors.get('firstname')"></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Apellidos</label>
                                        <input type="text" name="lastname" class="form-control" v-model="fillEmployee.lastname">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('lastname')" v-text="fillEmployee.errors.get('lastname')"></span>
                                </div>
                            </div>
                            <div class="row">                                                                
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email address</label>
                                        <input type="email" class="form-control" v-model="fillEmployee.email" name="email">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('email')" v-text="fillEmployee.errors.get('email')"></span>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        {{-- crear una tabla con estos campos --}}
                                        <label class="control-label">Area</label>
                                        <div>
                                            <input name="group5" type="radio" id="radio_1" class="with-gap radio-col-orange" v-model="fillEmployee.area" value="administracion">
                                            <label for="radio_1" style="font-size: 14px;">Administración</label>                                
                                            <input name="group5" type="radio" id="radio_2" class="with-gap radio-col-teal" v-model="fillEmployee.area" value="comercial">
                                            <label for="radio_2" style="font-size: 14px;">Comercial</label>
                                            <input name="group5" type="radio" id="radio_3" class="with-gap radio-col-red" v-model="fillEmployee.area" value="farmacia">
                                            <label for="radio_3" style="font-size: 14px;">Farmacia</label>
                                        </div>                                        
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('area')" v-text="fillEmployee.errors.get('area')"></span>
                                </div>            
                            </div>
                            <div class="row">                                
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        {{-- crear una tabla con estos campos --}}
                                        <label class="control-label">Centro de Operación</label>
                                        <select class="form-control" v-model="fillEmployee.CO">
                                            <option value="001">OFICINA PRINCIPAL</option>
                                            <option value="016">FARMACIA PUEBLO NUEVO</option>
                                            <option value="017">FARMACIA VALENCIA</option>
                                            <option value="018">FARMACIA LORICA</option>
                                            <option value="024">FARMACIA MONTELIBANO</option>
                                            <option value="026">FARMACIA AMPAROS</option>
                                        </select>
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('CO')" v-text="fillEmployee.errors.get('CO')"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Tipo Nomina</label>
                                     <select class="form-control show-tick" v-model="fillEmployee.type_nomina">
                                        <option value="P">Oficina Principal</option>
                                        <option value="F">Farmacias</option>
                                        <option value="T">Todos</option>
                                    </select>                                
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('type_nomina')" v-text="fillEmployee.errors.get('type_nomina')"></span>
                                </div>                 
                            </div>  
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">                                        
                                        <label class="control-label">Fecha Ingreso</label>
                                        <input type="date" name="admissiondate" class="form-control" v-model="fillEmployee.admissiondate">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('admissiondate')" v-text="fillEmployee.errors.get('admissiondate')"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Fecha Retiro</label>
                                        <input type="date" name="retirementdate" class="form-control" v-model="fillEmployee.retirementdate">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('retirementdate')" v-text="fillEmployee.errors.get('retirementdate')"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">                                                                                
                                        <label class="control-label">Salario Mensual</label>
                                        <input type="number" name="salary" class="form-control" v-model="fillEmployee.salary">
                                    </div>
                                    <span  class="label label-danger" v-if="fillEmployee.errors.has('salary')" v-text="fillEmployee.errors.get('salary')"></span>
                                </div>
                            </div>                       
                            <button type="submit" class="btn btn-primary pull-right">Modificar</button>
                            <div class="clearfix"></div>
                        </form>
                </div>                
            </div>
        </div>
    </div>
</div>