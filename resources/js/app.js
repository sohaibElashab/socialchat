require("./bootstrap");

window.Vue = require("vue").default;

import Vue from "vue";
import VueRouter from "vue-router";
import VueSplide from "@splidejs/vue-splide";
import sidebar from "./components/Sections/general_section/static_section/sidebar.vue";
import topbar from "./components/Sections/general_section/static_section/topbar.vue";
import rightbar from "./components/Sections/general_section/static_section/rightbar.vue";
import bottombar from "./components/Sections/general_section/static_section/bottombar.vue";

Vue.use(VueRouter);
Vue.use(VueSplide);
Vue.component("sidebar", sidebar);
Vue.component("topbar", topbar);
Vue.component("rightbar", rightbar);
Vue.component("bottombar", bottombar);

import Home from "./components/Pages/home.vue";
import Profile from "./components/Pages/profile.vue";
import signIn from "./components/Pages/signIn.vue";
import signUp from "./components/Pages/signUp.vue";
import profileEdit from "./components/Pages/profileEdit.vue";
// import confirmmail from './components/Pages/confirmmail.vue'

const routes = [
    {
        path: "/",
        component: Home
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile
    },
    {
        path: "/signIn",
        component: signIn
    },
    {
        path: "/signUp",
        component: signUp
    },
    {
        path: "/profileEdit",
        component: profileEdit
    }
    // {
    //     path: '/confirmmail',
    //     component: confirmmail
    // }
];

const router = new VueRouter({ routes });

const app = new Vue({
    router
}).$mount("#app");
