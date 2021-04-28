require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueSplide from '@splidejs/vue-splide';
import sidebar from './components/Sections/general_section/static_section/sidebar.vue'
import topbar from './components/Sections/general_section/static_section/topbar.vue'
import rightbar from './components/Sections/general_section/static_section/rightbar.vue'
import bottombar from './components/Sections/general_section/static_section/bottombar.vue'
import loader from './components/Sections/general_section/static_section/loader.vue'


Vue.use(VueRouter)
Vue.use( VueSplide );
Vue.component('sidebar',sidebar)
Vue.component('topbar',topbar)
Vue.component('rightbar',rightbar)
Vue.component('bottombar',bottombar)
Vue.component('loader',loader)

import Home from './components/Pages/home.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        }
    ],
});

const app = new Vue({
    router,
}).$mount('#app');


