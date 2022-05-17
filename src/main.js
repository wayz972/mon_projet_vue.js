import { createApp } from 'vue'
import {library} from'@fortawesome/fontawesome-svg-core'
import {fas} from '@fortawesome/free-solid-svg-icons'
import {faGithub,faLinkedinIn,faFacebookF,faTwitter,faGoogle,faInstagram} from '@fortawesome/free-brands-svg-icons'
import{FontAwesomeIcon}from '@fortawesome/vue-fontawesome'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import "bootstrap/dist/css/bootstrap.min.css"
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import "bootstrap/dist/js/bootstrap.min.js"
import VueAxios from 'vue-axios'
import store from './store'
 import '@fortawesome/fontawesome-free/js/all'
library.add(fas,faGithub,faLinkedinIn,faFacebookF,faGoogle,faTwitter,faInstagram)
createApp(App).component('fa',FontAwesomeIcon).use(router).use(VueAxios, axios).use(store).mount('#app')
