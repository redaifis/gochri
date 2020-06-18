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

// Sweetalert
import VueSweetalert2 from 'vue-sweetalert2';
// If you don't need the styles, do not connect
// import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Admin Dashboard
Vue.component('admin-dashboard', require('./admin/AdminDashboard.vue').default);

/* ------- Orders -------- */
const orders = require.context('./admin/orders', true, /\.vue$/i)
orders.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], orders(key).default))

/* ------- Products ------- */
const products = require.context('./admin/products', true, /\.vue$/i)
products.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], products(key).default))

/* ------- Categories ------- */
const categories = require.context('./admin/categories', true, /\.vue$/i)
categories.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], categories(key).default))

/* ------- Subcategories ------- */
const subcategories = require.context('./admin/subcategories', true, /\.vue$/i)
subcategories.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], subcategories(key).default))

/* ------- Users ------- */
const users = require.context('./admin/users', true, /\.vue$/i)
users.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], users(key).default))

/* ------- Profile ------- */
Vue.component('edit-profile', require('./admin/EditProfile.vue').default);

/* ------- Settings ------- */
const settings = require.context('./admin/settings', true, /\.vue$/i)
settings.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], settings(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const admin = new Vue({
    el: '#admin',
});
