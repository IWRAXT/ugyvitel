require('./bootstrap');
// require('daterangepicker');
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vuetable-2/dist/vuetable-2.css'
import 'vuetable-2/dist/vuetable-2-full'


window.Vue = require('vue');

Vue.component('modal', require('./components/Modal'));
Vue.component('notification', require('./components/Notification'));

//Employees
Vue.component('people', require('./components/Employees.vue'));
Vue.component('directs',require('./components/Directs'));
Vue.component('directsList',require('./components/DirectsList'));
Vue.component('employee',require('./components/addEmployee'));
Vue.component('edit_employee',require('./components/editEmployee'));

//Users
Vue.component('addUser',require('./components/addUser'));
Vue.component('users',require('./components/Users'));
Vue.component('my_user',require('./components/myUser'));
Vue.component('permission',require('./components/Permissions'));
Vue.component('edit_user',require('./components/editUser'));

//Sites
Vue.component('index_sites',require('./components/Sites'));
Vue.component('create_site',require('./components/addSite'));
Vue.component('edit_site',require('./components/editSite'));
Vue.component('site_employees',require('./components/Site_employees'));

//Costs-cost_types
Vue.component('costs',require('./components/Costs'));
Vue.component('cost',require('./components/addCost'));
Vue.component('edit_cost',require('./components/editCost'));
Vue.component('cost_types',require('./components/Cost_types'));
Vue.component('cost_type',require('./components/addCost_type'));
Vue.component('edit_cost_type',require('./components/editCost_type'));

//Suppliers
Vue.component('index_suppliers',require('./components/Suppliers'));
Vue.component('create_supplier',require('./components/addSupplier'));
Vue.component('edit_supplier',require('./components/editSupplier'));





// function install(Vue){
//     Vue.component("vuetable", Vuetable);
//     Vue.component("vuetable-pagination", VueTablePagination);
//     Vue.component("vuetable-pagination-dropdown", VueTablePaginationDropDown);
//     Vue.component("vuetable-pagination-info", VueTablePaginationInfo);
// }


let app = new Vue({
    el: '#app'

});

