<div class="modal fabe" id="amortizarLibranza">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Amortizar Libranza</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    {{-- formulario de edición --}}
                    <form   @submit.prevent="amortizarLibranza" 
                            @keydown="amortizacion.errors.clear($event.target.name)" 
                            @Change="amortizacion.errors.clear($event.target.name)">                        
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Fecha Inicial:</b></p>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="fecha_inic" class="form-control" v-model="amortizacion.fecha_inic">
                                    </div>
                                    <span  class="label label-danger" v-if="amortizacion.errors.has('fecha_inic')" v-text="amortizacion.errors.get('fecha_inic')"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><b>Fecha Final</b></p>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="fecha_final" class="form-control" v-model="amortizacion.fecha_final">
                                    </div>
                                    <span  class="label label-danger" v-if="amortizacion.errors.has('fecha_final')" v-text="amortizacion.errors.get('fecha_final')"></span>
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