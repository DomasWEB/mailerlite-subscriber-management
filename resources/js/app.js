import Buefy from 'buefy';
import routes from './routes';
import VueRouter from 'vue-router';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(Buefy, {
    defaultIconPack: 'fas'
});

Vue.use(VueRouter);

const router = new VueRouter({
    routes
});

class Api {
    url(endpoint) {
        return '/api/' + endpoint;
    }

    get(endpoint, data = []) {
        return axios.get(this.url(endpoint), data);
    }

    post(endpoint, data = []) {
        return axios.post(this.url(endpoint), data);
    }

    put(endpoint, data = []) {
        return axios.put(this.url(endpoint), data);
    }

    delete(endpoint) {
        return axios.delete(this.url(endpoint));
    }
}

window.ApiClient = new Api;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
