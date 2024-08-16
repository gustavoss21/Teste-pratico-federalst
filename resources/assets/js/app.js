
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import example_component from './components/ExampleComponent.vue';
import ListCarComponente from './components/ListCarComponente.vue';
import CarComponente from './components/CarComponente.vue';
import LoginComponente from './components/LoginComponente.vue';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', example_component);
Vue.component('list-car-component', ListCarComponente);
Vue.component('car-component', CarComponente);
Vue.component('login-component', LoginComponente);

const app = new Vue({
    el: '#app'
});
