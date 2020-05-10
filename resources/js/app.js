require('./bootstrap');

window.Vue = require('vue');

// for testing only
Vue.component('dashboard', require('./app/customer/dashboard/Dashboard.vue').default);


const app = new Vue({
    el: '#app',
});
