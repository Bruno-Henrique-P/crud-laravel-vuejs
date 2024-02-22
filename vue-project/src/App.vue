
import { RouterLink } from 'vue-router/dist/vue-router.prod.cjs';
<template>
  <nav>
    <RouterLink :to="{name:'orcamentos'}"><a style="text-decoration: none;">Oficina 2.0</a></RouterLink>
  </nav>
  <router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
  background-color: rgb(30, 199, 15);
  
}

nav a{
  font-weight: bold;
  color: black;
  text-decoration: none;
  font-size:xx-large;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
