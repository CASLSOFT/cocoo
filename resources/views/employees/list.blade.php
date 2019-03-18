@extends('layouts.nomina')

@section('title')
    Consulta Empleados
@endsection

@section('page-header')

@endsection
@section('page-content')
<div class="col-lg-10">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="col-md-6">
                Lista de Empleados
            </div>
            <div style="text-align: right">
                <button @click="getInactivos" type="button" class="btn bg-teal waves-effect">Inactivos</button>
                <button @click="getActivos" type="button" class="btn bg-teal waves-effect">Activos</button>
          </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo ID</th>
                            <th>N° ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Salario</th>
                            <th>Tipo Nomina</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in employees.data">
                            <td v-text="index+1"></td>
                            <td v-text="item.typecc"></td>
                            <td v-text="item.identificacion"></td>
                            <td v-text="item.firstname"></td>
                            <td v-text="item.lastname"></td>
                            <td v-text="item.salary"></td>
                            <td v-text="item.type_nomina" style="text-align: center;"></td>
                            <td>
                                <a href="#" @click.prevent="getEdit(item)" data-target="#ModalUser"><i class="material-icons">edit</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <vue-pagination  :pagination="employees" @paginate="getEmployees()" :offset="2"></vue-pagination>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->

@include('employees.edit')

@endsection

@section('footer-scripts')

<script type="text/javascript">


    var vm = new Vue({
        el: '#main',
        data: {
            fillEmployee: new Form({
                id: '',
                typecc:'',
                identificacion:'',
                firstname:'',
                lastname:'',
                position: '',
                contract: '',
                email:'',
                area:'',
                CO:'',
                type_nomina:'',
                admissiondate:'',
                retirementdate:'',
                salary:''
            }),
            employees: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            status: 1,
        },
        mounted() {
            this.getEmployees();
        },
        methods: {
            getInactivos(){
                this.status = 0;
                this.getEmployees();
            },
            getActivos(){
                this.status = 1;
                this.getEmployees();
            },
            getEmployees() {
                let url = 'employees/list/' + this.status + '?page='+this.employees.current_page;
                axios.get(url).then(response => {
                    this.employees = response.data;
                });
            },
            getEdit(item) {
                this.fillEmployee.id = item.id;
                this.fillEmployee.typecc = item.typecc;
                this.fillEmployee.identificacion = item.identificacion;
                this.fillEmployee.firstname = item.firstname;
                this.fillEmployee.lastname = item.lastname;
                this.fillEmployee.position = item.position;
                this.fillEmployee.contract = item.contract;
                this.fillEmployee.email = item.email;
                this.fillEmployee.area = item.area;
                this.fillEmployee.CO = item.CO;
                this.fillEmployee.type_nomina = item.type_nomina;
                this.fillEmployee.admissiondate = item.admissiondate;
                this.fillEmployee.retirementdate = item.retirementdate;
                this.fillEmployee.salary = item.salary;

                $('#edit').modal('show');
            },
            getActive(id) {
                let url = 'employee/active/'+id;
                axios.put(url).then(response => {
                        this.getLibranzas();
                    });
            },
            updateEmployee(id) {
                let url = 'employee/'+id;
                this.fillEmployee.submit('put',url)
                .then(response => {
                    this.fillEmployee;
                    $('#edit').modal('hide');
                    toastr.success('Actualizado', 'Empleado');
                    this.getEmployees();
                })
                .catch(error => this.fillEmployee.errors.record(error.response.data));
            }
        }
    });

</script>
@endsection