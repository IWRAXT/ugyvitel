require('./bootstrap');


window.Vue = require('vue');

//Vue.component('articles',require('./components/Articles.vue'));
Vue.component('people', require('./components/PersonComponent.vue'));
Vue.component('directs',require('./components/Directs'));
Vue.component('directsList',require('./components/DirectsList'));
Vue.component('modal', require('./components/Modal'));



const app = new Vue({
    el: '#app',
    data: {

    }
});
