<template>
<div class="col-md-10">
    <div class="container-fluid" v-if="!orderDraft.draft">
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-4">
                <div class="card">
                    <div class="header" style="display: flex; justify-content: center;">
                        <form name="form-order-create"  @submit.prevent="create()">
                            <button type="submit" class="btn bg-deep-purple waves-effect">
                                <i class="material-icons">send</i>
                                <span>CREAR SOLICITUD DE PEDIDO DE {{ category | mayuscula }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
    <div class="card" v-if="orderDraft.draft">
        <!-- /.panel-heading -->
        <div class="body">
            <div class="row">
                <div class="col-md-12">
                    <vue-searcharticle @itemselect="showArticles" :category="category"></vue-searcharticle>
                </div>
            </div>
            <div class="row" v-if="items.id">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    ARTICULOS DE {{ category }}
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row" style="display: flex; justify-content: center;">
                                    <div class="col-sm-6 col-md-6" >
                                        <div class="thumbnail">
                                            <img :src="items.imagen"  width="160px" style="height: 210px">
                                            <div class="caption">
                                                <h3 v-text="items.name"></h3>
                                                <h5 v-text="items.trademark"></h5>
                                                <p v-text="items.description"></p>
                                                <hr>
                                                <form name="form-pedido-details-create"  @submit.prevent="addArticle()">
                                                        <div class="input-group spinner" data-trigger="spinner">
                                                            <div class="form-line focused">
                                                                <input type="number" class="form-control text-center" min="1" value="1" data-rule="quantity" required v-model="detailOrder.quantity">
                                                            </div>
                                                        </div>
                                                    <p>
                                                        <button type="submit" class="btn btn-block btn-lg bg-deep-purple waves-effect">
                                                            <i class="material-icons">save</i>
                                                            <span>GUARDAR</span>
                                                        </button>
                                                    </p>
                                                </form>
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
        <!-- /.panel-body -->
    </div>
</div>
</template>
<script>
    export default{
        data(){
            return {
                form: new Form({
                    user_id: '',
                    category: this.category
                }),
                items: {},
                detailOrder: new Form({
                    article_id: '',
                    order_id: '',
                    quantity: 1
                }),
                order: '',
                orderDraft: ''
            }
        },
        props: ['category'],
        mounted() {
            this.getOrdersDraft();
        },
        methods: {
            showArticles(id){
                this.detailOrder.article_id = id;
                this.detailOrder.order_id = this.order;
                this.detailOrder.quantity = 1;
                axios.get('/requisiciones/article/' + id)
                  .then(response => this.items = response.data);
            },
            create(datos) {
                this.form.submit('post','/requisiciones/order')
                .then(response => {this.getOrdersDraft(this.category)})
                .catch(error => this.form.errors.record(error.errors));
            },
            addArticle(datos) {
                this.detailOrder.submit('post','/requisiciones/detailorder')
                .then(response => {
                    this.items = {},
                    toastr.success('Articulo adicionado con exito al Pedido!', 'Pedido');
                })
                .catch(error => this.form.errors.record(error.errors));
            },
            getOrdersDraft() {
                let url = '/requisiciones/ordersxuser/active/'+ this.category;
                axios.get(url).then(response => {
                    this.orderDraft = response.data;
                    this.order = response.data.id;
                });
            }
        },
        filters: {
            mayuscula: function (value) {
                return value.toUpperCase();
            }
        }
    }
</script>