<template>
    
    <form @submit.prevent="updatecliente" novalidate>
        <label for="name" class="form-label">alterar Name</label>
        <input v-model="cliente.name" type="text" placeholder="Enter name" class="form-control">
        <button>
            submit
        </button>
    </form>
</template>
<script>
import axios from 'axios'
export default{
    name: "addCliente",
    data(){
        return {
            cliente: {},
            name: '',

        }
    },
    created(){
        this.getClientesid() 
    },  
    methods:{
        async getClientesid(){
            let url = `http://127.0.0.1:8000/api/getcliente/${this.$route.params.id}`
            await axios.get(url).then(response =>{
                console.log(response)
                this.cliente = response.data;
            });
        },
        async updatecliente(){
            let formData = new FormData();
            formData.append('name',this.cliente.name)
            let url = `http://127.0.0.1:8000/api/updatecliente/${this.$route.params.id}`;
            await axios.post(url,formData).then((response) =>{
                console.log(response)
                if(response.status == 200){
                    alert(response.data.message)
                }
            })
        }
    },
    mounted(){
        console.log("edit")
    }

}
</script>