<template>
    <div class="iq-sidebar" v-if="user">
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li
                        :class="UrlHref == menu.href ? 'active' : ''"
                        v-for="menu in menus"
                        :key="menu.id"
                    >
                        <div v-if="menu.href == '/profile'">
                            <!-- params: { id: user.id }, -->
                            <router-link
                                class="iq-waves-effect"
                                :to="{
                                    name: 'profile',
                                    query: { user: user.id }
                                }"
                                tag="a"
                                exact=""
                                ><i :class="menu.iClass"></i
                                ><span>{{ menu.SpanName }}</span></router-link
                            >
                        </div>
                        <div v-else>
                            <router-link
                                class="iq-waves-effect"
                                :to="menu.href"
                                tag="a"
                                exact=""
                                ><i :class="menu.iClass"></i
                                ><span>{{ menu.SpanName }}</span></router-link
                            >
                        </div>
                    </li>
                    <li>
                        <a
                            class="iq-waves-effect"
                            @click="logout"
                            style="cursor:pointer;"
                        >
                            <i class="ri-login-box-line"></i><span>logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            UrlHref: "",
            user: null,
            menus: {
                "1": {
                    id: 1,
                    href: "/",
                    iClass: "las la-newspaper",
                    SpanName: "Newsfeed"
                },
                "2": {
                    id: 2,
                    href: "/profile",
                    iClass: "las la-user",
                    SpanName: "Profile"
                },
                "3": {
                    id: 3,
                    href: "/Chat",
                    iClass: "lab la-rocketchat",
                    SpanName: "Chat"
                },
                "4": {
                    id: 4,
                    href: "/Notification",
                    iClass: "las la-bell",
                    SpanName: "Notification"
                },
                "5": {
                    id: 5,
                    href: "/profileVideos",
                    iClass: "las la-video",
                    SpanName: "Profile Video"
                },
                "6": {
                    id: 6,
                    href: "/profileImages",
                    iClass: "las la-image",
                    SpanName: "Profile Image"
                },
                "7": {
                    id: 7,
                    href: "/friendRequest",
                    iClass: "las la-anchor",
                    SpanName: "Friend Request"
                },
                "8": {
                    id: 8,
                    href: "/friendList",
                    iClass: "las la-user-friends",
                    SpanName: "Friend Lists"
                },
                "9": {
                    id: 9,
                    href: "/Saved",
                    iClass: "ri-bookmark-3-line",
                    SpanName: "Saved"
                }
            }
        };
    },
    methods: {
        logout(e) {
            e.preventDefault();
            axios.post("/LogoutUser").then(res => {
                this.$router.push({ name: "signIn" });
            });
        }
    },
    created() {
        this.UrlHref = "/" + window.location.href.split("/")[4];

        axios.get("/profile").then(res => {
            this.user = res.data;
            this.menus[2].href = "/profile?user=" + this.user.id;
        });
    }
};
</script>
