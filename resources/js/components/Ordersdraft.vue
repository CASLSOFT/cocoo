<template>
    <div class="table-responsive m-t-35">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="height: 50px; width: 50px;">Imagen</th>
                    <th>Descripción</th>
                    <th width="80px">Cantidad</th>
                    <th width="80px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(article, index) in orderDraftArticles.data">
                    <template v-if="! article.editing">
                        <td v-text="index+1"></td>
                        <td style="padding: 5px"><img class="thumbnail" :src="'/'+ article.imagen"
                            style="height: 50px; width: 50px; padding: 0px; margin: 0px;"></td>
                        <td v-text="article.name" class="align-bottom"></td>
                        <td v-text="article.quantity" class="text-center"></td>
                        <td>
                            <a href="#" @click.prevent="editSalida(article)"><i class="material-icons">edit</i></a>
                            <a href="#" @click.prevent="deleteSalida(article)"><i class="material-icons">delete</i></a>
                        </td>
                    </template>
                    <template v-else>
                        <td v-text="index+1"></td>
                        <td style="padding: 5px"><img class="thumbnail" :src="'/' + article.imagen"
                            style="height: 50px; width: 50px; padding: 0px; margin: 0px;"></td>
                        <td v-text="article.name" class="align-bottom"></td>
                        <td><input type="number" v-model="draft.quantity" min="1" style="width: 60px; color: black;"></td>
                        <td>
                            <a href="#" @click.prevent="updateSalida(draft)"><i class="material-icons">check</i></a>
                            <a href="#" @click.prevent="cancel(article)"><i class="material-icons">cancel</i></a>
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
        <vue-pagination  :pagination="orderDraftArticles" @paginate="getArticleOrdersUser()" :offset="2"></vue-pagination>
    </div>
</template>
<script>
    // import EventBus from '../bus'

    export default{
        data(){
            return {
            orderDraftArticles: {
                order_id:'',
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            draft: {},
            fillOrderDraft: new Form({
                id: '',
                quantity:'',
            }),
            }
        },
        props: ['category'],
        mounted() {
            this.getArticleOrdersUser();
        },
        methods: {
            deleteSalida: function (salida) {
                var url = '/requisiciones/detailorder/' + salida.article_id;
                axios.delete(url).then(response => {
                    this.getArticleOrdersUser();
                    toastr.success('Eliminado correctamente')
                });
            },
            editSalida(salida) {
                this.draft = $.extend({}, salida);
                Vue.set(salida, 'editing', true);
            },
            cancel: function(salida){
                salida.editing = false;
                this.draft = {};
            },
            updateSalida: function (draft) {
                var url = '/requisiciones/detailorder/' + draft.id;
                axios.put(url, {
                    id: draft.article_id,
                    quantity: draft.quantity
                })
                .then(response => {
                    toastr.success('Actualizado', 'Articulo');
                    this.draft = {};
                    this.getArticleOrdersUser();
                });
            },
            getArticleOrdersUser() {
                let url = '/requisiciones/ordersxuser/drafts/'+ this.category +'?page='+this.orderDraftArticles.current_page;;
                axios.get(url).then(response => this.orderDraftArticles = response.data);
            }
        }
    }
</script>