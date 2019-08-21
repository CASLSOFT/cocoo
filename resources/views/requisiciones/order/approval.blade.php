@extends('layouts.requisiciones')

@section('title')
    DASHBOARD
@endsection

@section('page-header')

@endsection
@section('page-content')
<div class="container-fluid">
    <div class="block-header">
        <h2>APROBACIÓN DE PEDIDOS</h2>
    </div>
    @can('order.approvalorder')
	<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ Auth::user()->firstname }}
                        <small>Acontinuación <code>Aprobaras los pedidos</code> del area <code>{{ strtoupper(Auth::user()->area) }}</code>.</small>
                    </h2>
                </div>
                <div class="body table-responsive">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_11" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-teal" v-for="(order, index) in orders">
                                            <div class="panel-heading" role="tab" :id="getClassheading(index)">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_11" :href="getClasshref(index)" aria-expanded="false" :aria-controls='getClass(index)' class="collapsed">
                                                        Pedido del Usuario @{{ order.user.firstname }} @{{ order.user.lastname }} con email @{{ order.user.email }} solicitada @{{ order.created_at }}
                                                    </a>
	                                                <button @click="approvalOrder(order.id)" type="button" class="btn btn-small bg-blue waves-effect">Aprobar</button>
                                                </h4>
                                            </div>
                                            <div :id='getClass(index)' class="panel-collapse collapse" role="tabpanel" :aria-labelledby="getClassheading(index)" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    {{-- table --}}
                                                      <div class="body table-responsive">
								                        <table class="table table-hover">
								                            <thead>
								                                <tr>
								                                    <th>#</th>
								                                    <th>&nbsp;</th>
								                                    <th>ARTICULO</th>
								                                    <th class="text-center">CANTIDAD</th>
								                                    <th class="text-center">Opciones</th>
								                                </tr>
								                            </thead>
								                            <tbody>
								                                <tr v-for="(item, index) in order.detailorders">
							                                        <template v-if="! item.editing">
							                                            <td v-text="index+1"></td>
							                                            <th><img :src="item.article.imagen" class="img-thumbnail" style="width: 40px; height: 40px;"></th>
							                                            <td v-text="item.article.name"></td>
							                                            <td v-text="item.quantity" class="text-center"></td>
							                                            <td>
							                                                @can('detailorder.edit')
							                                                <a href="#" @click.prevent="editSalida(item)"><i class="material-icons">edit</i></a>
							                                                @endcan
							                                                @can('detailorder.destroy')
							                                                <a href="#" @click.prevent="deleteSalida(item)"><i class="material-icons">delete</i></a>
							                                                @endcan
							                                            </td>
							                                        </template>
							                                        <template v-else>
							                                            <td v-text="index+1"></td>
							                                            <th><img :src="item.article.imagen" class="img-thumbnail" style="width: 40px; height: 40px;"></th>
							                                            <td v-text="item.article.name"></td>
							                                            <td><input type="number" v-model="draft.quantity" ></td>
							                                            <td>
							                                                <a href="#" @click.prevent="updateSalida(draft)"><i class="material-icons">check</i></a>
							                                                <a href="#" @click.prevent="cancel(item)"><i class="material-icons">cancel</i></a>
							                                            </td>
							                                        </template>
							                                    </tr>
								                            </tbody>
								                        </table>
								                    </div>
                                                    {{-- end table --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('footer-scripts')
<script type="text/javascript">


    var vm = new Vue({
        el: '#main',
        data: {
            draft: {},
            orders: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            position: ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'],
            offset: 4,
            area: 'administracion',
        },
        mounted() {
            this.getOrders();
        },
        methods: {
            getClass(id){

                return "collapse"+this.position[id]+"_11";
            },
            getClasshref(id){
                return "#collapse"+this.position[id]+"_11";
            },
            getClassheading(id){
                return "heading"+this.position[id]+"_11";
            },
            getOrders() {
                let url = '/requisiciones/approval/user/area?page='+this.orders.current_page;
                axios.get(url).then(response => {
                    this.orders = response.data;
                });
            },
            deleteSalida: function (salida) {
                var url = '/requisiciones/detailorder/' + salida.id;
                axios.delete(url).then(response => {
                    this.getOrders();
                    toastr.success('Eliminado correctamente')
                });
            },
            editSalida(salida) {
                this.draft = $.extend({}, salida);
                Vue.set(salida, 'editing', true);
            },
            cancel: function(salida){
                salida.editing = false;
            },
            updateSalida: function (draft) {
                var url = '/requisiciones/detailorder/' + draft.id;
                axios.put(url, {
                    quantity: draft.quantity,
                    id: draft.id
                })
                .then(response => {
                    toastr.success('Actualizado', 'Articulo');
                    this.getOrders();
                })
                .catch(error => this.fillEmployee.errors.record(error.response.data));
            },
            approvalOrder(id) {
            	var url = '/requisiciones/order/approval/' + id;
                axios.put(url, {id: id})
                .then(response => {
                    toastr.success('Actualizado', 'Articulo');
                    this.getOrders();
                })
                .catch(error => this.fillEmployee.errors.record(error.response.data));
            }
        }
    });

</script>
@endsection