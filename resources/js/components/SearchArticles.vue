<template>
    <div>
        <input type="text" placeholder="Digita nombre del articulos..." v-model="query" v-on:keyup="autoComplete" class="form-control">
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group">
                <li class="list-group-item" v-for="result in results">
                    <label>
                        <a href="#" @click.prevent="elementSelect(result.id)">
                            {{ result.name }}
                        </a>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    // import EventBus from '../bus'

    export default{

        data(){
            return {
                query: '',
                results: []
            }
        },
        props: ['category'],
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 2){
                  axios.get('/requisiciones/articles/search'+'?query='+this.query+'&category='+ this.category)
                  .then(response => {
                    this.results = response.data;
                  });
                }
            },
            elementSelect(id){
                this.$emit('itemselect', id);
                this.results = [];
                this.query = '';
            }
        }
    }
</script>