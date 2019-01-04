<div class="modal fabe bd-example-modal-lg" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Libranza</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                    <form @submit.prevent="updateLibranza(fillLibranza.id)" 
                            @keydown="fillLibranza.errors.clear($event.target.name)" 
                            @Change="fillLibranza.errors.clear($event.target.name)">
                        <div class="row">                        
                            <div class="col-md-4">
                                <p><b># Cuota Mensual</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_mensual" class="form-control text-center" v-model="fillLibranza.cuota_mensual">
                                        <span  class="label label-danger" v-if="fillLibranza.errors.has('cuota_mensual')" v-text="fillLibranza.errors.get('cuota_mensual')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b># Cuota Quincenal</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_quincenal" class="form-control text-center" v-model="fillLibranza.cuota_quincenal">
                                        <span  class="label label-danger" v-if="fillLibranza.errors.has('cuota_quincenal')" v-text="fillLibranza.errors.get('cuota_quincenal')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b># Cuota De:</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_de" class="form-control text-center" v-model="fillLibranza.cuota_de">
                                        <span  class="label label-danger" v-if="fillLibranza.errors.has('cuota_de')" v-text="fillLibranza.errors.get('cuota_de')"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><b># Cuota Hasta</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_hasta" class="form-control text-center" v-model="fillLibranza.cuota_hasta">
                                        <span  class="label label-danger" v-if="fillLibranza.errors.has('cuota_hasta')" v-text="fillLibranza.errors.get('cuota_hasta')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b>Entidad Recaudadora</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="text" name="entidad" class="form-control text-center" v-model="fillLibranza.entidad" disabled="true">
                                        <span  class="label label-danger" v-if="fillLibranza.errors.has('entidad')" v-text="fillLibranza.errors.get('entidad')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    {{-- crear una tabla con estos campos --}}
                                    <label class="control-label">Categoria</label>
                                    <select class="form-control" v-model="fillLibranza.category" name="category">
                                        {{-- <option value="">Seleccione</option> --}}
                                        <option value="LIBRANZA">Libranza</option>
                                        <option value="DESCUENTO">Descuento Voluntario</option>
                                        <option value="EMBARGO">Embargo</option>
                                    </select>
                                </div>
                                <span  class="label label-danger" v-if="fillLibranza.errors.has('category')" v-text="fillLibranza.errors.get('category')"></span>
                            </div>
                        </div>
                        <div class="row">
                        </div>                                    
                        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                        <div class="clearfix"></div>
                    </form>
                    {{-- formulario de edición --}}
                <div class="row">
                </div>                
            </div>
        </div>
    </div>
</div>