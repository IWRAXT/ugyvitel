require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue');

//Vue.component('articles',require('./components/Articles.vue'));
Vue.component('people', require('./components/PersonComponent.vue'));
Vue.component('directs',require('./components/Directs'));
Vue.component('directsList',require('./components/DirectsList'));
Vue.component('modal', require('./components/Modal'));
Vue.component('addUser',require('./components/addUser'));



const app = new Vue({
    el: '#app',
    data: {

    }
});
