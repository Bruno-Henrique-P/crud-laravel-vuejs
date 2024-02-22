<template>
  <div class="home">
    <OrcamentoComponent />
  </div>
</template>

<script>
// @ is an alias to /src

import OrcamentoComponent from "@/components/OrcamentoComponet.vue"

export default {
  name: 'HomeView',
  components: {
    OrcamentoComponent
}
}
</script>
