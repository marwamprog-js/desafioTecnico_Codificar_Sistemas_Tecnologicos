import { createApp } from 'vue'
import App from './App.vue'
import router from './router/router'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import './axios'
import store from './vuex'
import AlertError from './components/AlertErrorComponent.vue';

const Vue = createApp(App)
Vue.use(store);
Vue.use(router);
Vue.component('AlertError', AlertError)

Vue.mount('#app')
