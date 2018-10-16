require('./bootstrap');
// require('daterangepicker');
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vuetable-2/dist/vuetable-2.css'
import 'vuetable-2/dist/vuetable-2-full'


window.Vue = require('vue');

Vue.component('modal', require('./components/Modal'));

//Employees
Vue.component('people', require('./components/PersonComponent.vue'));
Vue.component('directs',require('./components/Directs'));
Vue.component('directsList',require('./components/DirectsList'));
Vue.component('employee',require('./components/addEmployee'));
Vue.component('edit_employee',require('./components/editEmployee'));

//Users
Vue.component('addUser',require('./components/addUser'));
Vue.component('users',require('./components/Users'));
Vue.component('my_user',require('./components/myUser'));
Vue.component('permission',require('./components/addPermission'));

//Sites
Vue.component('sites',require('./components/SitesComponent'));
Vue.component('create_site',require('./components/addSite'));

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

