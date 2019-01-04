<div class="modal fabe" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Base Novedades</h4>
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    {{-- formulario de edición --}}
                    <form @submit.prevent="updateNovelty(fillNovelty.id)" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                    <legend>Periodo de Novedad</legend>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fecha Inicial</label>
                                                    <input type="date" name="f_initial" class="form-control" v-model="fillNovelty.f_initial" disabled="true">
                                                </div>                                                
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fecha Final</label>
                                                    <input type="date" name="f_final" class="form-control" v-model="fillNovelty.f_final" disabled="true">
                                                </div>                                                
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tipo Nomina</label>
                                                    <input name="f_final" class="form-control" v-model="fillNovelty.type_nomina" disabled="true">
                                                </div>                                                
                                            </div>
                                        </div>                                        
                                    </fieldset>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Observaciones:</label>
                                        <ckeditor v-model="fillNovelty.observation" name="observation"></ckeditor>
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