@extends('layouts.nomina')

@section('title')
    Novedades
@endsection

@section('page-header')
    Ingreso de Novedades
@endsection

@section('page-content')
    <div class="container-fluid">
        @if($errors->all())
            <div class="alert alert-warning" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="background-color:#CD5DDD;">
                        <font color="white">
                            <h4 class="title">Crear Periodo</h4>
                        </font>
                    </div>
                    <div class="body" id="novedades">
                        <form method="POST" action="{{ route('novelty.store') }}" >                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                    <legend>Periodo de Novedad</legend>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fecha Inicial</label>
                                                <input type="date" name="f_initial" class="form-control" v-model="f_initial">
                                            </div>                                            
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fecha Final</label>
                                                <input type="date" name="f_final" class="form-control" v-model="f_final">
                                            </div>                                            
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tipo Nomina</label>
                                                 <select class="form-control" name="type_nomina" v-model="type_nomina">
                                                    <option value="">Seleccione</option>
                                                    <option value="P">Oficina Principal</option>
                                                    <option value="F">Farmacias</option>
                                                    <option value="T">Todos</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-2">
                                            <br>    
                                            <button type="submit" class="btn btn-primary pull-right" >crear</button>                                            
                                        </div>  
                                    </fieldset>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Observaciones:</label>
                                        <ckeditor name="observation" v-model="observation"></ckeditor>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
            
            </div> 
        </div>
    </div>
@endsection

@section('footer-scripts')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>    

    var vm = new Vue({
        el: '#main',
        data: {
            identificaion: '',
            f_initial: '',
            f_final:'',
            type_nomina:'',
            observation:'',
            actualiza: true,            
            noveltys: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4 
        },
        mounted() {
            this.getNoveltys();
        },        
        methods: {
            create(datos) {
                this.form.submit('post','/nomina/novelty')
                .then(response => {
                    toastr.success('Creado con exito!', 'Periodo');
                    this.getNoveltys();
                })
                .catch(error => {
                        if (error.message) {
                            toastr.error(error.message, 'Periodo de Novedad');
                        } else {
                            this.form.errors.record(error.errors)
                        }
                    });
            },
            getNoveltys() {
                let url = '/nomina/novelty?page='+this.noveltys.current_page;
                axios.get(url).then(response => {                        
                        this.noveltys = response.data;
                    });
            },            
            getEdit(item) {
                this.identificaion = item.id;
                this.f_initial = item.f_initial;
                this.f_final = item.f_final;
                this.observation = item.observation;
                this.type_nomina = item.type_nomina;
                this.actualiza = false;
                // $('#edit').modal('show');
            },
            // updateNovelty(id) {
            //     let url = '/nomina/novelty/'+id;
            //     this.fillNovelty.submit('put',url)
            //     .then(response => {                    
            //         this.fillNovelty;
            //         $('#edit').modal('hide');
            //         toastr.success('Actualizado', 'Novedad Actualizada');
            //         this.getNoveltys();
            //     })
            //     .catch(error => 
            //         {
            //             if (error.message) {
            //                 toastr.error(error.message, 'Periodo de Novedad');
            //             } else {
            //                 this.form.errors.record(error.response.data)
            //             }
            //         });
            // },
            getDelete(id) {
                let url = '/nomina/novelty/'+id;
                axios.delete(url).then(response => {
                        this.getNoveltys();
                        toastr.warning('Eliminado', 'Periodo de Novedad');
                    });
            },
        }
    });
</script>
@endsection
