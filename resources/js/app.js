
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
var Vue = require('vue');
//Vue.use(require('vue-resource'));

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


import UserList from './components/admin/UserList.vue';
import ProductList from './components/admin/ProductList.vue';
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-list', require('./components/admin/UserList.vue').default);
Vue.component('product-list', require('./components/admin/ProductList.vue').default);

/**resources\js\components\admin\UserList.vue
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
