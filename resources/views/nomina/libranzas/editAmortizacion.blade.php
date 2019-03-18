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
                    <form @submit.prevent="updateAmortizacion(fillAmortizacion.id)"
                            @keydown="fillAmortizacion.errors.clear($event.target.name)"
                            @Change="fillAmortizacion.errors.clear($event.target.name)">
                        <div class="row">
                            <div class="col-md-4">
                                <p><b>Fecha Inicial:</b></p>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="fecha_inic" class="form-control" v-model="fillAmortizacion.fecha_inic">
                                    </div>
                                    <span  class="label label-danger" v-if="fillAmortizacion.errors.has('fecha_inic')" v-text="fillAmortizacion.errors.get('fecha_inic')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b>Fecha Final</b></p>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="fecha_final" class="form-control" v-model="fillAmortizacion.fecha_final">
                                    </div>
                                    <span  class="label label-danger" v-if="fillAmortizacion.errors.has('fecha_final')" v-text="fillAmortizacion.errors.get('fecha_final')"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    {{-- crear una tabla con estos campos --}}
                                    <label class="control-label">Categoria</label>
                                    <select class="form-control" v-model="fillAmortizacion.category" name="category">
                                        <option value="LIBRANZA">Libranza</option>
                                        <option value="DESCUENTO">Descuento Voluntario</option>
                                        <option value="EMBARGO">Embargo</option>
                                    </select>
                                </div>
                                <span  class="label label-danger" v-if="fillAmortizacion.errors.has('category')" v-text="fillAmortizacion.errors.get('category')"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><b># Cuota Mensual</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_mensual" class="form-control text-center" v-model="fillAmortizacion.cuota_mensual">
                                        <span  class="label label-danger" v-if="fillAmortizacion.errors.has('cuota_mensual')" v-text="fillAmortizacion.errors.get('cuota_mensual')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b># Cuota Quincenal</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_quincenal" class="form-control text-center" v-model="fillAmortizacion.cuota_quincenal">
                                        <span  class="label label-danger" v-if="fillAmortizacion.errors.has('cuota_quincenal')" v-text="fillAmortizacion.errors.get('cuota_quincenal')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p><b># Cuota De:</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="numeric" name="cuota_de" class="form-control text-center" v-model="fillAmortizacion.cuota_de">
                                        <span  class="label label-danger" v-if="fillAmortizacion.errors.has('cuota_de')" v-text="fillAmortizacion.errors.get('cuota_de')"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Entidad Recaudadora</b></p>
                                <div class="input-group input-group-md">
                                    <div class="form-line">
                                        <input type="text" name="entidad" class="form-control text-center" v-model="fillAmortizacion.entidad">
                                        <span  class="label label-danger" v-if="fillAmortizacion.errors.has('entidad')" v-text="fillAmortizacion.errors.get('entidad')"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                        <div class="clearfix"></div>
                    </form>
                    {{-- formulario de edición --}}
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>