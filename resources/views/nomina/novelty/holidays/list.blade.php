@extends('layouts.nomina')

@section('title')
    Consulta Empleados
@endsection

@section('page-header')

@endsection
@section('page-content')
<div class="col-lg-10">
    @can('holiday.list')
        <div class="panel panel-info">
            <div class="panel-heading">
                Listado de Vacaciones
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CO</th>
                                <th>Empleado</th>
                                <th style="text-align: center">Desde</th>
                                <th style="text-align: center">Hasta</th>
                                <th style="text-align: center">Días Disfrutados</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in holidays.data">
                                <td v-text="index+1"></td>
                                <td v-text="item.co"></td>
                                <td v-text="item.firstname + item.lastname"></td>
                                <td v-text="item.since" style="text-align: center"></td>
                                <td v-text="item.until" style="text-align: center"></td>
                                <td v-text="item.days" style="text-align: center"></td>
                                <td>
                                    {{-- <a href="#" :class="item.status == 1 ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-remove'"
                                    @click="getActive(item.id)" alt="Activar o Inactivar Usuario"></a> --}}
                                    <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="fa fa-edit fa-fw"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <vue-pagination  :pagination="holidays" @paginate="getHolidays()" :offset="2"></vue-pagination>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    @endcan
    <!-- /.panel -->
</div>

<!-- Modal -->
@can('holiday.edit')
    @include('nomina.novelty.holidays.edit')
@endcan

@endsection

@section('footer-scripts')

<script type="text/javascript">


    var vm = new Vue({
        el: '#main',
        data: {
            status:1,
            fillHoliday: new Form({
                id: '',
                since:'',
                until:'',
                days:''
            }),
            holidays: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4
        },
        mounted() {
            this.getHolidays();
        },
        methods: {
            getHolidays() {
                let url = '/nomina/holidays/list?page='+this.holidays.current_page;
                axios.get(url).then(response => {
                        this.holidays = response.data;
                    });
            },
            getEdit(item) {
                this.fillHoliday.id = item.id;
                this.fillHoliday.since = item.since;
                this.fillHoliday.until = item.until;
                this.fillHoliday.days = item.days;

                $('#edit').modal('show');
            },
            updateVacaciones(id) {
                let url = '/nomina/holiday/'+id;
                this.fillHoliday.submit('put',url)
                .then(response => {
                    this.fillHoliday;
                    $('#edit').modal('hide');
                    toastr.success('Actualizada', 'Vacaciones');
                    this.getHolidays();
                })
                .catch(error => this.fillHoliday.errors.record(error.response.data));
            }
        }
    });

</script>
@endsection