require('./bootstrap');

window.Vue = require('vue');

// for testing only
Vue.component('checkout-component', require('./app/test/Checkout.vue').default);


const app = new Vue({
    el: '#app',
});
