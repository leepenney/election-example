require('./bootstrap');

import Vue from 'vue'

import App from './vue/app'
import Results from './vue/results'

import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

const currentRoute = window.location.pathname;

if (currentRoute == '/results') {
    const results = new Vue({
        el: '#results',
        components: { Results }
    });
}else {
    const app = new Vue({
        el: '#app',
        components: { App }
    });
}