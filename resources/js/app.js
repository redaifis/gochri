require('./bootstrap');

window.Vue = require('vue');

// Checkout
Vue.component('checkout-component', require('./app/checkout/Checkout.vue').default);

/* ------- Customer -------- */
const customer = require.context('./app/customer', true, /\.vue$/i)
customer.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], customer(key).default))

Vue.component('login-component', require('./app/auth/LoginComponent.vue').default);

const app = new Vue({
    el: '#app',
});
