
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Error from './errors';
window.Errors = Error;

import Form from './form';
window.Form = Form;

window.toastr = require('toastr');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('VuePagination', require('./components/Pagination.vue'));
Vue.component('VueAutocomplete', require('./components/Autocomplete.vue'));
Vue.component('VueSearchrole', require('./components/Searchrole.vue'));
Vue.component('VueSearchuser', require('./components/Searchuser.vue'));
Vue.component('VueSearcharticle', require('./components/SearchArticles.vue'));
Vue.component('VueOrdersdraft', require('./components/Ordersdraft.vue'));
Vue.component('ckeditor', require('./components/Ckeditor.vue'));
Vue.component('VueAddarticleorder', require('./components/Addarticleorder.vue'));

// if (process.env.MIX_APP_ENV === 'production') {
//     Vue.config.devtools = false;
//     Vue.config.debug = false;
//     Vue.config.silent = true;
// }
// const app = new Vue({
//     el: '#main'
// });