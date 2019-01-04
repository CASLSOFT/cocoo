<div class="modal fabe" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Retención</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    {{-- formulario de edición --}}
                    <form @submit.prevent="updateHEs(fillRetencion.id)" 
                            @keydown="fillRetencion.errors.clear($event.target.name)" 
                            @Change="fillRetencion.errors.clear($event.target.name)">
                        <div class="row">                    
                                <div class="col-md-4">
                                    <p><b>Fecha Retención: </b></p>
                                    <div class="input-group input-group-md">                                        
                                        <div class="form-line">
                                            <input id="lapso" type="date" name="lapso" class="form-control" v-model="fillRetencion.lapso">
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="fillRetencion.errors.has('lapso')" v-text="fillRetencion.errors.get('lapso')"></span>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Ingresos: </b></p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input id="income" type="text" name="income" class="form-control" style="text-align: right" v-model="fillRetencion.income">
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="fillRetencion.errors.has('income')" v-text="fillRetencion.errors.get('income')"></span>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Valor Retencón: </b></p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input id="value" type="text" name="value" class="form-control" style="text-align: right" v-model="fillRetencion.value">                                            
                                        </div>
                                    </div>
                                    <span  class="label label-danger" v-if="fillRetencion.errors.has('value')" v-text="fillRetencion.errors.get('value')"></span>
                                </div>                                
                                
                            </div> 
                        {{-- <div class="row">                    
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fecha Retención: </label>
                                    <input id="lapso" type="date" name="lapso" class="form-control" v-model="fillRetencion.lapso">
                                </div>
                                <span  class="label label-danger" v-if="fillRetencion.errors.has('lapso')" v-text="fillRetencion.errors.get('lapso')"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Ingresos: </label>
                                    <input id="income" type="text" name="income" class="form-control" style="text-align: right" v-model="fillRetencion.income">
                                </div>
                                <span  class="label label-danger" v-if="fillRetencion.errors.has('income')" v-text="fillRetencion.errors.get('income')"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Valor Retencón: </label>
                                    <input id="value" type="text" name="value" class="form-control" style="text-align: right" v-model="fillRetencion.value">
                                </div>
                                <span  class="label label-danger" v-if="fillRetencion.errors.has('value')" v-text="fillRetencion.errors.get('value')"></span>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-10">
                                <p><b>Procedimiento</b></p>
                                <select class="form-control show-tick" v-model="fillRetencion.process" name="process">
                                    <option>Seleccione</option>
                                    <option value="1">Opcion 1</option>
                                    <option value="2">Opcion 2</option>                                                
                                </select>                                    
                                <span  class="label label-danger" v-if="fillRetencion.errors.has('process')" v-text="fillRetencion.errors.get('process')"></span>
                            </div>                            
                            <div class="col-md-2">
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