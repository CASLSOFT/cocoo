<template>
    <div>
        <input type="text" placeholder="Digita Role a Buscar" v-model="query" v-on:keyup="autoComplete" class="form-control">
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
        methods: {
            autoComplete(){
                this.results = [];

                if(this.query.length > 2){
                  axios.get('/role/search',{params: {query: this.query}})
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