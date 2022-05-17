import { createRouter, createWebHashHistory } from 'vue-router'
import ContacterVue from '../views/Contacter.vue'
import ConnecterVue from '../views/Connecter.vue'
import AccueilVue from '../views/Accueil.vue'
import FormulaireVue from '../views/Formulaire.vue'
import SalleVue from '../components/Salle.vue'
import FormulaireProVue from '../views/FormulairePro.vue'
import ProfilProVue from '../views/ProfilPro.vue'
import DisplayVue from '../views/Display.vue'
import sidebar from '../components/Sidebar'
const routes = [

  {
    path: '/',
    name: 'Accueil',
    component: AccueilVue
  },
  {
    path: '/formulaire',
    name: 'Formulaire',
    component: FormulaireVue
  },
  {
    path: '/contacter',
    name: 'Contacter',
    component: ContacterVue
  },
  {
    path: '/connecter',
    name: 'Connecter',
    component: ConnecterVue
  },

  {
    path: '/salle',
    name: 'Salle',
    component: SalleVue
  },

  {
    path: '/formulairepro',
    name: 'FormulairePro',
    component: FormulaireProVue
  },
  {
    path: '/profilpro',
    name: 'ProfilPro',
    component: ProfilProVue
  },
  {
    path: '/display',
    name: 'display',
    component: DisplayVue
  },
  {
    path: '/sidebar',
    name: 'sidebar',
    component: sidebar
  },




]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
