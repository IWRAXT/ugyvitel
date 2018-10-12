require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vuetable-2/dist/vuetable-2.css'


window.Vue = require('vue');

//Vue.component('articles',require('./components/Articles.vue'));
Vue.component('people', require('./components/PersonComponent.vue'));
Vue.component('directs',require('./components/Directs'));
Vue.component('directsList',require('./components/DirectsList'));
Vue.component('modal', require('./components/Modal'));
Vue.component('addUser',require('./components/addUser'));
Vue.component('permission',require('./components/addPermission'));
Vue.component('employee',require('./components/addEmployee'));
Vue.component('edit_employee',require('./components/editEmployee'));

// function install(Vue){
//     Vue.component("vuetable", Vuetable);
//     Vue.component("vuetable-pagination", VueTablePagination);
//     Vue.component("vuetable-pagination-dropdown", VueTablePaginationDropDown);
//     Vue.component("vuetable-pagination-info", VueTablePaginationInfo);
// }


const app = new Vue({
    el: '#app',
    data: {

    }
});
