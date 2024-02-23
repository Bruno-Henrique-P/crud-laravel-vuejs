<template>
    <div class="topo">   
        <span>Orçamentos</span> 
        <div class="box-search">
          <div class="seacrh-field">
            <label class="form-label" for="search">Pesquisar</label>
            <input v-model="search" name="search" type="search" placeholder="Pesquisar" class="form-control">
            <button class="btn btn-primary" @click="pesquisar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
          </div>
          <div class="col-md-3">
          <label class="form-label" for="dateInit">Data Inicial</label>
            <input v-model="dataIni" name="dateInit" type="date" class="form-control">
          </div>

          <div class="col-md-3">
          <label class="form-label" for="dateFim">Data Final</label>
            <input  v-model="dataFim" name="dateFim" type="date" class="form-control">
          </div>
        </div>
        <br>
        <router-link :to="{name:'CriarOracemnto'}" class="btn btn-primary btn-sm">Criar Orçamento</router-link>
    </div> 
    <div class="redi">
    
    <table class="table table-hover">
    <thead>
      <tr class="table-success">
        <th scope="col">id</th>
        <th scope="col">Vendedor</th>
        <th scope="col">Cliente</th>
        <th scope="col">Descrição</th>
        <th scope="col">Valor</th>
        <th scope="col">Data Criação</th>
        <th row="6">editar</th>
      </tr>
    </thead>
    <tbody>
      <tr  v-for="(orcamento,index) in orcamentos" :key="orcamento.id">
        <th scope="row">{{orcamento.id}}</th>
        <td>{{orcamento.nameVendedor}}</td>
        <td>{{orcamento.nameCliente}}</td>
        <td>{{orcamento.descricao}}</td>
        <td>R$ {{orcamento.valor}}</td>
        <td>{{orcamento.created_at}}</td>
        <td>
          <div class="actions">
          <button @click="getOrca(index)" class="btn btn-light btn-sm action-itens" :id="orcamento.id" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <svg :id="orcamento.id" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
          </svg>
          </button>
          <router-link :to="{name:'updateorcamento',params: {id:orcamento.id}}" class="btn btn-success btn-sm action-itens"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
          </svg>
          </router-link>
          <button @click="orcaIdDel(orcamento.id)" class="btn btn-danger btn-sm action-itens" data-bs-toggle="modal" data-bs-target="#deleteModal" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
            </svg>
          </button>
        </div>
        </td>
      </tr>
    </tbody>
  </table>
<nav class="pagina">
  <ul class="pagination">
    <li class="page-item">
      <a @click="previuos" class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li v-for="page in pages" :key="page" :class="{active:source.current_page == page}" class="page-item"><a @click="NUmberButton" class="page-link" href="#">{{page}}</a></li>
    <li class="page-item">
      <a @click="next" class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
  </nav> 
  
</div>

<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Informações do Oraçamento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-floating mb-3">
            
            <input v-model="orcamento.id" name="id"  type="number" class="form-control" disabled>
            <label class="form-label" for="id">ID</label>
        </div>
        
      <div class="form-floating mb-3">
          <input class="form-control" type="text" name="cliente" disabled v-model="orcamento.cliente">
          <label class="form-label" for="cliente">Cliente</label>
      </div>

      <div class="form-floating mb-3">
        <input class="form-control" type="text" name="vendedor" disabled v-model="orcamento.vendedor">
        <label for="vendedor">Vendedor</label>
        
      </div>
        
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px;"  v-model="orcamento.descricao" disabled></textarea>
            <label for="floatingTextarea2">Descrição</label>
        </div>
       
        <div class="form-floating mb-3">
          
          <input class="form-control" type="number" name="valor" disabled v-model="orcamento.valor">
          <label class="form-label" for="valor">Valor R$</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger"  role="alert">
          Tem certeza que deseja excluir o Orcamento de Id {{ deleteOrcaId }}
        </div>
      </div>
      <div class="modal-footer">
        <button @click.prevent="deleteOrcamento(deleteOrcaId)" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Deletar</button>
        <button data-bs-dismiss="modal" @click="voltarTela" type="button" class="btn btn-primary">Close</button>
      </div>
    </div>
  </div>
</div>



  </template>
  
  <script>
  import axios from 'axios'
  let current_page = 0
  export default {
    name: 'OrcamentoComponent',
    data(){
      return {
        orcamentos:Array,
        search: '',
        rows: 0,
        last_page:0,
        perPage: 15,
        currentPage: 0,
        source:{},
        pages:0,
        dataIni:'',
        dataFim:'',
        showModal:false,
        orcamento:{},
        deleteOrcaId:0
      } 
    },
    created(){
      this.pesquisar();
    },
    methods: {
      async deleteOrcamento(id){
        let url = `http://127.0.0.1:8000/api/deleteorcamento/${id}`;
        await axios.delete(url).then(response=>{
          if(response.data.code == 200){
            alert(response.data.message)
            this.pesquisar()
          }
        }).catch(error =>{
          console.log(error)
        })
      },
      orcaIdDel(id){
        this.deleteOrcaId = id
      },
      async pesquisar(){
        let url = `http://127.0.0.1:8000/api/search`
        let formData = new FormData();
        if (!(this.search == '')){
          formData.append("search",this.search)
        }
        formData.append("dataInit",this.dataIni)
        formData.append("dataFim",this.dataFim)
        await axios.post(url,formData).then(response=>{
            this.genericFun(response)
            this.pages= response.data.last_page
            this.last_page= response.data.last_page
        })
       
      },
      async NUmberButton(data){
        current_page = data.target.innerHTML
        let url = `http://127.0.0.1:8000/api/search?page=${current_page}`
        let formData = new FormData();
        formData.append("search",this.search )
        await axios.post(url,formData).then(response=>{
            this.genericFun(response)
            this.pages= response.data.last_page
        })
      },

      async previuos(){
        let page = current_page - 1
        if (page < 1 ){
          page = 1
        }
        current_page = page
      let url = `http://127.0.0.1:8000/api/search?page=${page}`
        let formData = new FormData();
        formData.append("search",this.search )
        await axios.post(url,formData).then(response=>{
            this.genericFun(response)
            this.rows = response.data.last_page
        }) 
      },
      async next()  {
        let page = current_page + 1
        if (page > this.last_page ){
          page = this.last_page
        }
        current_page = page
      let url = `http://127.0.0.1:8000/api/search?page=${page}`
        let formData = new FormData();
        formData.append("search",this.search )
        await axios.post(url,formData).then(response=>{
          this.genericFun(response)
        })
        
      },
      getOrca(index){
        this.orcamento = this.orcamentos[index]
      },  

      generatePagesArray(currentPage, collectionLength, rowsPerPage, paginationRange){
      var pages = [];
      var totalPages = Math.ceil(collectionLength / rowsPerPage);
      var halfWay = Math.ceil(paginationRange / 2);
      var position;

      if (currentPage <= halfWay) {
          position = 'start';
      } else if (totalPages - halfWay < currentPage) {
          position = 'end';
      } else {
          position = 'middle';
      }

      var ellipsesNeeded = paginationRange < totalPages;
      var i = 1;
      while (i <= totalPages && i <= paginationRange) {
          var pageNumber = this.calculatePageNumber(i, currentPage, paginationRange, totalPages);
          var openingEllipsesNeeded = (i === 2 && (position === 'middle' || position === 'end'));
          var closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'));
          if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
              pages.push('...');
          } else {
              pages.push(pageNumber);
          }
          i ++;
      }
      return pages;
  },
  calculatePageNumber(i, currentPage, paginationRange, totalPages)
{
    var halfWay = Math.ceil(paginationRange/2);
    if (i === paginationRange) {
        return totalPages;
    } else if (i === 1) {
        return i;
    } else if (paginationRange < totalPages) {
        if (totalPages - halfWay < currentPage) {
        return totalPages - paginationRange + i;
    } else if (halfWay < currentPage) {
        return currentPage - halfWay + i;
    } else {
        return i;
    }
    } else {
        return i;
    }
},
    consertarData(){
      for(let i = 0 ; i < this.orcamentos.length; i++ ){
        this.orcamentos[i].created_at = new Date(this.orcamentos[i].created_at).toLocaleDateString()
      }
    },
    genericFun(response){
      this.orcamentos = response.data.data
      this.source = response.data
      this.consertarData()
    }
},
    watch:{
      source(){
        let s = this.source
        this.pages = this.generatePagesArray(s.current_page,s.total,s.per_page,10)
        current_page = s.current_page
      },
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
  /* .topo{
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
    padding: 0 700px;
  } */
  table{
    border: 2px solid black;
    padding: 0 200px;
  }
  .redi{
    padding: 0 300px;
  }
  .box-search{
    display: flex;
    justify-content: center;
    gap: .1%;
    padding: 0 300px;
  }
  .pagina{
  display: flex;
  justify-content: center;
  align-items: center;
}
/* .seacrh-field{
  display: flex;
  flex-direction: row;
} */
.actions{
  display: flex;
  justify-content: center;
  align-items: center;
}
  </style>
  