<template>
    <div class="alert alert-danger mt-4" v-if="errors.length">
        <ul>
            <li v-for="(error,index) in errors" :key="index">
                {{ error }}
            </li>
        </ul>
    </div>
    <form @submit.prevent="saveCliente" novalidate>
        <label for="name" class="form-label">Name</label>
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
            errors: []
        }
    },
    methods:{
        async saveCliente(){
            if(!this.cliente.name){
                this.errors.push("Nome é necessario")
            }
             if(!this.errors.length){
                let formData = new FormData();
                formData.append('name',this.cliente.name)
                let url = "http://127.0.0.1:8000/api/savecliente"
                await axios.post(url,formData).then((response) =>{
                    console.log(response)
                    if(response.status == 200){
                        alert(response.data.message)
                    }
                })
            }
        }
    },
    unmounted(){

    }

}
</script>