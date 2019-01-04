<div class="modal fabe" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Vacaciones</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    {{-- formulario de edición --}}
                    <form @submit.prevent="updateHEs(fillHE.id)" 
                            @keydown="fillHE.errors.clear($event.target.name)" 
                            @Change="fillHE.errors.clear($event.target.name)">
                        <div class="row">                        
                            <div class="col-md-5">
                                <p><b>Fecha HE o Mes: </b></p>
                                <div class="form-group label-floating">
                                    <input id="lapso" type="date" name="lapso" class="form-control" v-model="fillHE.lapso">
                                </div>
                                <span  class="label label-danger" v-if="fillHE.errors.has('lapso')" v-text="fillHE.errors.get('lapso')"></span>
                            </div>
                            <div class="col-md-7">
                                <p><b>Tipo de HE o Comisión</b></p>
                                <select class="form-control show-tick" v-model="fillHE.typeHE" name="typeHE">
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
                                <span  class="label label-danger" v-if="fillHE.errors.has('typeHE')" v-text="fillHE.errors.get('typeHE')"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p><b># HE o Valor Comision</b></p>
                                <div class="input-group input-group-lg">
                                    <div class="form-line">
                                        <input type="numeric" name="value" class="form-control" v-model="fillHE.value" style="text-align: right">
                                    </div>
                                </div>
                                <span  class="label label-danger" v-if="fillHE.errors.has('value')" v-text="fillHE.errors.get('value')"></span>
                            </div>
                            <div class="col-md-4">
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
</div>