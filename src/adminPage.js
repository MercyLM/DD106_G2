import Vue from 'vue';
import App from './admin.vue';
import router from './router';
import axios from "axios";
// import VueAxios from "vue-axios";

import "@/js/components";
import "@/style/main.scss";

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.config.productionTip = false;

Vue.prototype.$http = axios;

new Vue({
  router,
  render: function (h) { return h(App); }
}).$mount('#app');
