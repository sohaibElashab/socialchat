<template>
    <div class="right-sidebar-mini" style="z-index: ">
        <div class="right-sidebar-panel p-0">
            <div class="iq-card shadow-none">
                <div class="iq-card-body p-0">
                    <div class="media-height p-3" v-if="friends">
                        <div
                            class="media align-items-center mb-4"
                            v-for="friend in friends"
                            :key="friend.id"
                        >
                            <div
                                class="iq-profile-avatar"
                                :class="friend.statu"
                            >
                                <img
                                    class="rounded-circle avatar-50"
                                    :src="
                                        `images/user/${friend.profileimg.name}`
                                    "
                                    alt=""
                                />
                            </div>
                            <div class="media-body ml-3">
                                <h6 class="mb-0">
                                    <!-- <a href="#">{{friend.name}}</a>:to="friend.href" -->
                                    <router-link
                                        :to="{
                                            name: 'chat',
                                            query: { user: friend.id }
                                        }"
                                        tag="a"
                                    >
                                        {{ friend.name }}
                                    </router-link>
                                </h6>
                                <p class="mb-0">{{ friend.time }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-sidebar-toggle bg-primary mt-3">
                        <i class="ri-arrow-left-line side-left-icon"></i>
                        <i class="ri-arrow-right-line side-right-icon"
                            ><span class="ml-3 d-inline-block"
                                >Close Menu</span
                            ></i
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            friends: null,
            changed: false,
            DBfriends: null,
            OnlineUser: null,
            friendsLL: {
                "1": {
                    id: 1,
                    statu: "status-online",
                    href: "/",
                    img: "images/user/01.jpg",
                    name: "Anna Sthesia",
                    time: "Just Now"
                },
                "2": {
                    id: 2,
                    statu: "status-online",
                    href: "/",
                    img: "images/user/02.jpg",
                    name: "Paul Molive",
                    time: "Just Now"
                },
                "3": {
                    id: 3,
                    statu: "status-online",
                    href: "/",
                    img: "images/user/03.jpg",
                    name: "Anna Mull",
                    time: "Just Now"
                },
                "4": {
                    id: 4,
                    statu: "status-online",
                    href: "/",
                    img: "images/user/04.jpg",
                    name: "Paige Turner",
                    time: "Just Now"
                },
                "5": {
                    id: 5,
                    statu: "status-away",
                    href: "/",
                    img: "images/user/11.jpg",
                    name: "Bob Frapples",
                    time: "Just Now"
                },
                "6": {
                    id: 6,
                    statu: "status-away",
                    href: "/",
                    img: "images/user/02.jpg",
                    name: "Barb Ackue",
                    time: "Just Now"
                },
                "7": {
                    id: 7,
                    statu: "status-away",
                    href: "/",
                    img: "images/user/03.jpg",
                    name: "Greta Life",
                    time: "Just Now"
                },
                "8": {
                    id: 8,
                    statu: "status-away",
                    href: "/",
                    img: "images/user/12.jpg",
                    name: "Ira Membrit",
                    time: "Just Now"
                },
                "9": {
                    id: 9,
                    statu: "status-offline",
                    href: "/",
                    img: "images/user/01.jpg",
                    name: "Pete Sariya",
                    time: "Just Now"
                },
                "10": {
                    id: 10,
                    statu: "status-offline",
                    href: "/",
                    img: "images/user/02.jpg",
                    name: "Monty Carlo",
                    time: "Just Now"
                }
            }
        };
    },
    mounted() {
        /* var ses = sessionStorage.getItem("OnlFriends");
        console.log("session friends");
        console.log(JSON.parse(ses));
        this.friends = JSON.parse(ses); */

        axios.get("/profile").then(res => {
            this.OnlineUser = res.data;
            console.log("aa");
            Echo.private(`acceptRequest.${this.OnlineUser.id}`).listen(
                "AcceptRequestEvent",
                e => {
                    console.log("bb");
                    this.load();
                }
            );
        });

        this.load();
    },
    methods: {
        checkFriend(id) {
            var p = null;
            this.DBfriends.forEach(friend => {
                if (friend.id == id) {
                    p = friend;
                    return true;
                }
            });
            return p;
        },
        checkOnlineFriend(id) {
            var p = null;
            this.friends.forEach(friend => {
                if (friend.id == id && this.checkFriend(id) != null) {
                    p = friend;
                    return true;
                }
            });
            return p;
        },
        load() {
            axios
                .post("/LoadFriends", {
                    id: null
                })
                .then(res => {
                    console.log("friends");
                    console.log(res.data);
                    this.DBfriends = res.data;
                    axios.get("/OnlineUsers").then(res => {
                        console.log("on");
                        console.log(res.data);
                        var users = res.data;
                        users.forEach(user => {
                            if (this.checkFriend(user.user_id) != null) {
                                console.log(user);
                                var fr = this.checkFriend(user.user_id);
                                var index = this.DBfriends.indexOf(fr);
                                this.DBfriends[index].statu = "status-online";
                                this.DBfriends[index].time = "Online";
                            }
                        });
                        this.friends = this.DBfriends;
                    });
                    /*      Echo.join("users").here(users => {
                    console.log("changed");
                    users.forEach(user => {
                        if (this.checkFriend(user.id) != null) {
                            console.log(user);
                            var fr = this.checkFriend(user.id);
                            var index = this.DBfriends.indexOf(fr);
                            this.DBfriends[index].statu = "status-online";
                            this.DBfriends[index].time = "Online";
                        }
                    });
                    console.log("pp");
                    console.log(this.DBfriends);
                    this.friends = this.DBfriends;
                    sessionStorage.clear();

                    sessionStorage.setItem(
                        "OnlFriends",
                        JSON.stringify(this.friends)
                    );
                });
 */
                    Echo.private(`onlineFriend`).listen(
                        "OnlineFriendEvent",
                        e => {
                            if (this.checkOnlineFriend(e.user.id) != null) {
                                var fr = this.checkOnlineFriend(e.user.id);
                                var index = this.friends.indexOf(fr);
                                this.friends[index].statu = "status-online";
                                this.friends[index].time = "Online";
                                /* sessionStorage.clear();

                        sessionStorage.setItem(
                            "OnlFriends",
                            JSON.stringify(this.friends)
                        ); */
                            }
                        }
                    );

                    Echo.private(`offlineFriend`).listen(
                        "OfflineFriendEvent",
                        e => {
                            if (this.checkOnlineFriend(e.user.id) != null) {
                                var fr = this.checkOnlineFriend(e.user.id);
                                var index = this.friends.indexOf(fr);
                                this.friends[index].statu = "status-offline";
                                this.friends[index].time = "Offline";
                                /*    sessionStorage.clear();

                            sessionStorage.setItem(
                                "OnlFriends",
                                JSON.stringify(this.friends)
                            ); */
                            }
                        }
                    );
                });
        }
    }
};
</script>
