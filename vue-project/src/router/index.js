import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  
  {
    path: '/orcamentos',
    name: 'orcamentos',
    component: () => import ("../components/OrcamentoComponet.vue")
  },
  {
    path: '/Criarorcamentos',
    name: 'CriarOracemnto',
    component: () => import ("../components/CriarOrcamento.vue")
  },
  {
    path: '/updateorcamento/:id?',
    name: 'updateorcamento',
    component:() => import ("../components/updateOrcamento.vue")
  },
  {
    path: '/alert',
    name: 'alertComponent',
    component:() => import ("../components/alertComponent.vue")
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
