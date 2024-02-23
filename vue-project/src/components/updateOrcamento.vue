<template>
    <router-link v-if="isChanged" ></router-link>
    <form @submit.prevent="updatecliente" novalidate style="text-align: start;">
      <label for="id" class="form-label">ID</label>
        <input v-model="orcamento.id" type="text" placeholder="vendedor" id="id" class="form-control" disabled>

        <label for="vendedor" class="form-label">Vendedor</label>
        <input v-model="orcamento.nameVendedor" type="text" placeholder="vendedor" id="vendedor" class="form-control">

        <label for="cliente" class="form-label">Cliente</label>
        <input v-model="orcamento.nameCliente" type="text" placeholder="cliente" id="cliente" class="form-control">

        <label for="descrição" class="form-label">Descrição</label>
        <input v-model="orcamento.descricao" type="text" placeholder="descricao" id="descrição" class="form-control">

        <label for="valor" class="form-label">Valor R$</label>
        <input v-model="orcamento.valor" type="text" placeholder="valor" id="valor"  class="form-control">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> 
            submit
        </button>
    </form>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert" :class="{'alert-success' :!isDanger ,'alert-danger':isDanger}" role="alert">
          {{ mensagem }}
        </div>
      </div>
      <div class="modal-footer">
        <button v-if="isDanger" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button v-else data-bs-dismiss="modal" @click="voltarTela" type="button" class="btn btn-primary">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <alert-component :open="abrirAlert" :mensagem="mensagem"/> -->
   
</template>
<script>
import axios from 'axios'

// import { watch } from 'vue'
// import {toast}  from 'vue3-toastify'
// import 'vue3-toastify/dist/index.css'
export default{
    name: "updateOrcamento",
    data() {
        return {
            orcamento: {},
            descricao: '',
            Cliente: '',
            Vendedor: '',
            valor: 0,
            isChanged: false,
            mensagem:'',
            openModal: false,
            code:0,
            isDanger:true
        };
    },
    created() {
        this.getClientesid();
        
        
    },
    methods: {
        async getClientesid() {
            let url = `http://127.0.0.1:8000/api/getcorcamento/${this.$route.params.id}`;
            await axios.get(url).then(response => {
                this.orcamento = response.data;
            });
        },
        async updatecliente() {
            let formData = new FormData();
            formData.append('descricao', this.orcamento.descricao);
            formData.append('cliente', this.orcamento.nameCliente);
            formData.append('vendedores', this.orcamento.nameVendedor);
            formData.append('valor', this.orcamento.valor);
            let url = `http://127.0.0.1:8000/api/updateorcamento/${this.$route.params.id}`;
            await axios.post(url, formData).then((response) => {
                this.mensagem = response.data.message;
                this.code = response.data.code
                this.showToast()
            });
            // this.$router.push({
            //     path: '/orcamentos',
            //     name: 'orcamentos',
            //     component: () => import("../components/OrcamentoComponet.vue")
            // });
            this.openModal = true
            
        },
        async showToast(){
            if(this.code == 200){
                this.isDanger = false
            }else {
                this.isDanger = true
            }
            
            // this.$router.push({
            //     path: '/orcamentos',
            //     name: 'orcamentos',
            //     component: () => import("../components/OrcamentoComponet.vue")
            // });

        },
        voltarTela(){
           this.$router.push({
                path: '/orcamentos',
                name: 'orcamentos',
                component: () => import("../components/OrcamentoComponet.vue")
            });
        }
        
    },
    
}
</script>
<style>
.form-label{
  padding-left: 15px;
  font-weight: bold;
}
</style>