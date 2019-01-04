<div class="modal fabe" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="panel-heading" style="background-color:#CD5DDD;">
                    <font color="white">
                        <h4 class="title">Modificar Usario</h4>                        
                    </font>
                </div>                
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form @submit.prevent="updateUser(fillUser.id)" 
                    @keydown="fillUser.errors.clear($event.target.name)" 
                    @Change="fillUser.errors.clear('area')">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombres</label>
                                    <input type="text" class="form-control input-sm" v-model='fillUser.firstname'>
                                    <span  class="label label-danger" v-if="fillUser.errors.has('firstname')" v-text="fillUser.errors.get('firstname')"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Apellidos</label>
                                    <input type="text" class="form-control input-sm" v-model='fillUser.lastname'>
                                    <span  class="label label-danger" v-if="fillUser.errors.has('lastname')" v-text="fillUser.errors.get('lastname')"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">                               
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Username</label>
                                    <input type="text" class="form-control input-sm" v-model='fillUser.username' >
                                    <span  class="label label-danger" v-if="fillUser.errors.has('username')" v-text="fillUser.errors.get('username')"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Area</label>
                                     <select class="form-control input-sm" v-model='fillUser.area'>
                                        <option>Seleccione</option>
                                        <option value="administracion">Administracion</option>
                                        <option value="comercial">Comercial</option>
                                        <option value="farmacia">Farmacia</option>
                                    </select>
                                    <span  class="label label-danger" v-if="fillUser.errors.has('area')" v-text="fillUser.errors.get('area')"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">                                
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control input-sm" v-model='fillUser.email' >
                                    <span  class="label label-danger" v-if="fillUser.errors.has('email')" v-text="fillUser.errors.get('email')"></span>
                                </div>
                            </div>                            
                        </div>                   
                        <button class="btn btn-primary pull-right" :disabled="fillUser.errors.any()">Modificar</button>
                        <div class="clearfix"></div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>