@extends('layouts.requisiciones')

@section('title')
    Realizar Pedido
@endsection

@section('page-header')

@endsection
@section('page-content')

    @can('order.create')
    <vue-addarticleorder category="papeleria"></vue-addarticleorder>
    @endcan

@endsection

@section('footer-scripts')

<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
        // data: {
            // items: {},
            // form: new Form({
            //     user_id: '',
            //     category: 'papeleria'
            // }),
            // detailOrder: new Form({
            //     article_id: '',
            //     order_id: '',
            //     quantity: 1
            // }),
        //     order: '',
        //     orderDraft: '',
        //     orderApproval: ''
        // },
        // mounted() {
        //     this.getOrdersDraft('papeleria');
        // },
        // methods: {
            // showArticles(id){
            //     this.detailOrder.article_id = id;
            //     this.detailOrder.order_id = this.order;
            //     this.detailOrder.quantity = 1;
            //     axios.get('/requisiciones/article/' + id)
            //       .then(response => this.items = response.data);
            // },
            // create(datos) {
            //     this.form.submit('post','/requisiciones/order')
            //     .then(response => this.getOrdersDraft('papeleria'))
            //     .catch(error => this.form.errors.record(error.errors));
            // },
            // addArticle(datos) {
            //     this.detailOrder.submit('post','/requisiciones/detailorder')
            //     .then(response => {
            //         this.items = {},
            //         toastr.success('Articulo adicionado con exito al Pedido!', 'Pedido');
            //     })
            //     .catch(error => this.form.errors.record(error.errors));
            // },
        //     getOrdersDraft(category) {
        //         let url = '/requisiciones/ordersxuser/active/'+ category;
        //         axios.get(url).then(response => {
        //             this.orderDraft = response.data;
        //             this.order = response.data.id;
        //         });
        //     },
        // }
    });

</script>
@endsection