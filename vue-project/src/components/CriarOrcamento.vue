<template>
    <span>Criar Orçamento</span>
    <div class="alert alert-danger mt-4" v-if="errors.length">
        <ul>
            <li v-for="(error,index) in errors" :key="index">
                {{ error }}
            </li>
        </ul>
    </div>
    <form class="formOrcamento" @submit.prevent="saveCliente" novalidate>
        <label for="vendedor" class="form-label"></label>
        <input v-model="orcamento.vendedor" type="text" placeholder="Vendedor" class="form-control">

        <label for="cliente" class="form-label"></label>
        <input v-model="orcamento.cliente" type="text" placeholder="Cliente" class="form-control">

        <label for="descricao" class="form-label"></label>
        <input v-model="orcamento.descricao" type="text" placeholder="Descricao" class="form-control">

        <label for="valor" class="form-label"></label>
        <input v-model="orcamento.valor" type="number" placeholder="Valor" class="form-control">
        <button>
            submit
        </button>
    </form>
</template>
<script>
import axios from 'axios'
export default{
    name: "CriarOracemnto",
    data(){
        return {
            orcamento: {},
            descricao: '',
            valor: 0,
            vendedor:'',
            cliente:'',
            errors: []
        }
    },
    methods:{
        async saveCliente(){
            if(!this.orcamento.descricao){
                this.errors.push("descricao é necessario")
            }
            if(!this.orcamento.valor){
                this.errors.push("valor é necessario")
            }
            if(!this.orcamento.vendedor){
                this.errors.push("vendedor é necessario")
            }
            if(!this.orcamento.cliente){
                this.errors.push("cliente é necessario")
            }
            if(!this.errors.length){
                let formData = new FormData();
                formData.append('descricao',this.orcamento.descricao)
                formData.append('valor',this.orcamento.valor)
                formData.append('vendedores',this.orcamento.vendedor)
                formData.append('cliente',this.orcamento.cliente)
                let url = "http://127.0.0.1:8000/api/saveorcamento"
                console.log(formData)
                await axios.post(url,formData).then((response) =>{
                    if(response.status == 200){
                        console.log(response.data.message)
                    }
                })
            }
            this.$router.push({
                path: '/orcamentos',
                name: 'orcamentos',
                component: () => import ("../components/OrcamentoComponet.vue")
            })
        }
    },
    unmounted(){

    }

}
</script>
<style>
.formOrcamento{
    padding: 0 700px;
}

</style>
