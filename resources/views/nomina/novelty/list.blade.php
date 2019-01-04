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
            {{-- <div class="col-md-8">
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
                                            <button type="submit" class="btn btn-primary pull-right" v-if="actualiza">crear</button>
                                            <button type="submit" class="btn btn-primary pull-right" v-else>Actualizar</button>
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
            </div> --}}
            <div class="col-md-8">
                <div class="row clearfix">
                    <div class="card">                        
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha Inicial</th>
                                        <th>Fecha Final</th>
                                        <th>Tipo</th>
                                        <th style="text-align: center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in noveltys.data">
                                        <td v-text="index+1"></td>
                                        <td v-text="item.f_initial"></td>
                                        <td v-text="item.f_final"></td>
                                        <td v-text="item.type_nomina"></td>
                                        <td style="text-align: center">
                                            <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="material-icons">mode_edit</i></a>
                                            <a href="#" @click.prevent="getDelete(item.id)"><i class="material-icons">delete</i></a>
                                            <a :href="'pdf/' + item.id"><i class="material-icons xs-3">picture_as_pdf</i></a>
                                        </td>                                    
                                    </tr>                        
                                </tbody>
                            </table>
                            <vue-pagination  :pagination="noveltys" @paginate="getNoveltys()" :offset="2"></vue-pagination>
                        </div>                        
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    @include('nomina.novelty.edit')
@endsection

@section('footer-scripts')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>    

    var vm = new Vue({
        el: '#main',
        data: {            
            form: new Form({
                f_initial: '',
                f_final:'',
                type_nomina:'',
                observation:''
            }),
            fillNovelty: new Form({
                id: '',
                f_initial: '',
                f_final:'',
                type_nomina:'',
                observation:''
            }),
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
                
                this.fillNovelty.f_initial = item.f_initial;
                this.fillNovelty.f_final = item.f_final;
                this.fillNovelty.observation = item.observation;
                this.fillNovelty.type_nomina = item.type_nomina;
                
                $('#edit').modal('show');
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
