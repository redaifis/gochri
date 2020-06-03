require('./bootstrap');

window.Vue = require('vue');

// moment library
const moment = require('moment')
require('moment/locale/fr')
Vue.use(require('vue-moment'), {
    moment
})


// register jw pagination component globally
import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

// Checkout
// Vue.component('checkout-component', require('./app/checkout/Checkout.vue').default);

/* ------- Customer -------- */
// const customer = require.context('./app/customer', true, /\.vue$/i)
// customer.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], customer(key).default))

// Vue.component('login-component', require('./app/auth/LoginComponent.vue').default);


// Product pages
Vue.component('landing-page', require('./app/LandingPage.vue').default)
Vue.component('search-page', require('./app/SearchPage.vue').default)
Vue.component('product-page', require('./app/ProductPage.vue').default)

// Payment page
Vue.component('cart-page', require('./app/CartPage.vue').default)

// Thank you page
Vue.component('thank-you', require('./app/ThankYou.vue').default)

// Customer
Vue.component('customer-dashboard', require('./app/customer/CustomerDashboard.vue').default)
Vue.component('orders-page', require('./app/customer/OrdersPage.vue').default)
Vue.component('order-page', require('./app/customer/OrderPage.vue').default)
Vue.component('wishlist-page', require('./app/customer/WishlistPage.vue').default)
Vue.component('customer-compte', require('./app/customer/CustomerCompte.vue').default)

// Other pages
Vue.component('contact-page', require('./app/ContactPage.vue').default)
Vue.component('policy-page', require('./app/PolicyPage.vue').default)
Vue.component('about-page', require('./app/AboutPage.vue').default)
Vue.component('not-found', require('./app/NotFound.vue').default)

// Auth
Vue.component('login-page', require('./app/auth/LoginPage.vue').default)
Vue.component('register-page', require('./app/auth/RegisterPage.vue').default)


const app = new Vue({
    el: '#app',
});
