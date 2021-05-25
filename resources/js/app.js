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
import profileImages from "./components/Pages/profileImages.vue";
import profileVideos from "./components/Pages/profileVideos.vue";
import notification from "./components/Pages/notification.vue";
import friendRequest from "./components/Pages/friendRequest.vue";
import friendProfile from "./components/Pages/friendProfile.vue";
import friendList from "./components/Pages/friendList.vue";
import chat from "./components/Pages/chat.vue";
import resetPassword from "./components/Pages/resetPassword.vue";
import verifyEmail from "./components/Pages/verifyEmail.vue";
import post from "./components/Pages/post.vue";
import postEdit from "./components/Pages/postEdit.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
        props: true
    },
    {
        path: "/signIn",
        name: "signIn",
        component: signIn
    },
    {
        path: "/signUp",
        name: "signUp",
        component: signUp
    },
    {
        path: "/profileEdit",
        name: "profileEdit",
        component: profileEdit
    },
    {
        path: "/chat",
        name: "chat",
        component: chat
    },
    {
        path: "/profileImages",
        name: "profileImages",
        component: profileImages
    },
    {
        path: "/profileVideos",
        name: "profileVideos",
        component: profileVideos
    },
    {
        path: "/notification",
        name: "notificatio",
        component: notification
    },
    {
        path: "/friendRequest",
        name: "friendReque",
        component: friendRequest
    },
    {
        path: "/friendProfile",
        name: "friendProfile",
        component: friendProfile,
        props: true
    },
    {
        path: "/friendList",
        name: "friendList",
        component: friendList
    },
    {
        path: "/resetPassword",
        name: "resetPassword",
        component: resetPassword
    },
    {
        path: "/verifyEmail",
        name: "verifyEmail",
        component: verifyEmail
    },
    {
        path: "/post",
        name: "post",
        component: post
    },
    {
        path: "/postEdit",
        name: "postEdit",
        component: postEdit
    }
];

const router = new VueRouter({ routes });

const app = new Vue({
    router
}).$mount("#app");
