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
                    <form @submit.prevent="updateVacaciones(fillHoliday.id)" 
                            @keydown="fillHoliday.errors.clear($event.target.name)" 
                            @Change="fillHoliday.errors.clear($event.target.name)">
                        <div class="row">                        
                            <div class="col-md-4">
                                <p><b>Fecha Inicial</b></>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="since" class="form-control" v-model="fillHoliday.since">
                                    </div>
                                    <span  class="label label-danger" v-if="fillHoliday.errors.has('since')" v-text="fillHoliday.errors.get('since')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b>Fecha Final</b></p>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="until" class="form-control" v-model="fillHoliday.until">
                                    </div>
                                    <span  class="label label-danger" v-if="fillHoliday.errors.has('until')" v-text="fillHoliday.errors.get('until')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b>Días Disfrutados</b></p>
                                <div class="input-group input-group-lg">
                                    <div class="form-line">
                                        <input type="numeric" name="days" class="form-control" v-model="fillHoliday.days" style="text-align: center">
                                    </div>
                                    <span  class="label label-danger" v-if="fillHoliday.errors.has('days')" v-text="fillHoliday.errors.get('days')"></span>
                                </div>
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