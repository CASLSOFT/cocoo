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
                    <form @submit.prevent="updateTNLs(fillTNL.id)" 
                            @keydown="fillTNL.errors.clear($event.target.name)" 
                            @Change="fillTNL.errors.clear($event.target.name)">
                        <div class="row">                        
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fecha Inicial</label>
                                    <input type="date" name="since" class="form-control" v-model="fillTNL.since">
                                </div>
                                <span  class="label label-danger" v-if="fillTNL.errors.has('since')" v-text="fillTNL.errors.get('since')"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fecha Final</label>
                                    <input type="date" name="until" class="form-control" v-model="fillTNL.until">
                                </div>
                                <span  class="label label-danger" v-if="fillTNL.errors.has('until')" v-text="fillTNL.errors.get('until')"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group label-floating">
                                    {{-- crear una tabla con estos campos --}}
                                    <label class="control-label">Tipo de TNL</label>
                                    <select class="form-control" v-model="fillTNL.typeTNL" name="typeTNL">
                                        <option>Seleccione</option>
                                        <option value="EG">Enfermedad General</option>
                                        <option value="LM">Licencia Maternidad</option>
                                        <option value="LP">Licencia Paternidad</option>
                                        <option value="LL">Ley de Luto</option>
                                        <option value="SUP">Suspensión</option>
                                        <option value="PNR">Permiso No Remunerado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Días Disfrutados</label>
                                    <input type="numeric" name="days" class="form-control" v-model="fillTNL.days">
                                </div>
                                <span  class="label label-danger" v-if="fillTNL.errors.has('days')" v-text="fillTNL.errors.get('days')"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                        <div class="clearfix"></div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>