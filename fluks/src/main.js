import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App.vue'

Vue.use(VueResource);
Vue.config.productionTip = false;
//Vue.http.options.root = 'http://localhost:8000';

new Vue({
  render: h => h(App),
}).$mount('#app')
