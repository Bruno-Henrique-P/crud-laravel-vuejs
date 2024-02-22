
<template>


<div class="toast-container position-fixed bottom-0 end-0 p-3" >
  <div  id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img  class="rounded me-2" >
      <strong class="me-auto">Bootstrap</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ mensagem }}
    </div>
  </div>
</div>

<button @click="showProps()" type="button" class="btn btn-primary" id="liveToastBtn" data-bs-dismiss="liveToast">Show</button>


</template>
<script>
import { watch } from 'vue'
import {toast}  from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
export default{
    name:'alertComponent',
    props: ['mensagem','open'],
    setup(props){
        if (open){
            toast(`${props.mensagem}`, {
            autoClose: 1000
        })
        }
    watch(props.open, ()=>{
        
    })
        
   }
   

}

</script>