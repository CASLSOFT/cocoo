<template>
    <div>
        <div class="form-group">
            <select class="form-control">
              <option>-- Please select --</option>
              <option v-for="item in permissions" :value="item.id" @change.prevent="elementSelect(item.id)">{{ item.name }}</option>
            </select>
        </div>

    </div>
</template>
<script>
    export default{

        props: {
          group: {
              type: String,
              default: 'administrar'
          }
        },
        data(){
            return {
                query: '',
                permissions: {}
            }
        },
        mounted() {
            axios.get('/permissionxrole/' + this.group).then(response => this.permissions = response.data);
        },
        methods: {
            // autoComplete(){
            //     this.results = [];

            //     if(this.query.length > 2){
            //       axios.get('/role/search',{params: {query: this.query}})
            //       .then(response => {
            //         this.results = response.data;
            //       });
            //     }
            // },
            elementSelect(id){
                this.$emit('selectpermission', id);
                this.query = '';
            }
        }
    }
</script>