<template>
  Clientes <table></table>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">editar</th>
    </tr>
  </thead>
  <tbody v-for="cliente in clientes" :key="cliente.id">
    <tr>
      <th scope="row">{{cliente.id}}</th>
      <td>{{cliente.name}}</td>
      <td>
        <router-link :to="{name:'updateCLiente',params: {id:cliente.id}}" class="btn btn-success btn-sm">update</router-link>
        <button class="btn btn-danger btn-sm" @click.prevent="deleteCliente(cliente.id)">X</button></td>
    </tr>
  </tbody>
</table>
   
</template>

<script>
import axios from 'axios'
export default {
  name: 'ClientesComponent',
  data(){
    return {
      clientes:Array
    } 
  },
  created(){
    this.getClientes();
  },
  methods: {
    async getClientes(){
      let url = 'http://127.0.0.1:8000/api/cliente'
      await axios.get(url).then(response =>{
        this.clientes = response.data.cliente;
        console.log(this.clientes)
      })
    },
    async deleteCliente(id){
      let url = `http://127.0.0.1:8000/api/deletecliente/${id}`;
      await axios.delete(url).then(response=>{
        if(response.data.code == 200){
          alert(response.data.message)
          this.getClientes()
        }
      }).catch(error =>{
        console.log(error)
      })
    }
  },

  mounted(){
    console.log("clintes apareceu")
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
