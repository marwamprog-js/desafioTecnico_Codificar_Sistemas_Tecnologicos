import { createApp } from 'vue'
import App from './App.vue'
import router from './router/router'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import './axios'
import './services/data.js'
import store from './vuex'
import AlertError from './components/AlertErrorComponent.vue';
import Notifications from '@kyvg/vue3-notification';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const Vue = createApp(App)
Vue.use(store);
Vue.use(router);
Vue.use(Notifications);
Vue.use(VueSweetalert2);

Vue.component('AlertError', AlertError)

Vue.mount('#app')
