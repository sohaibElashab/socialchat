<template>
    <div class="right-sidebar-mini" style="z-index: ">
        <div class="right-sidebar-panel p-0">
            <div class="iq-card shadow-none">
                <div
                    class="iq-card-body p-0"
                    v-if="friends != null && friends.length > 0"
                >
                    <div class="media-height p-3">
                        <router-link
                            tag="a"
                            :to="{
                                name: 'chat',
                                query: { user: friend.id }
                            }"
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
                                        <a>
                                            {{ friend.name }}
                                        </a>
                                    </h6>
                                    <p class="mb-0">{{ friend.time }}</p>
                                </div>
                        </router-link>
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
                <div class="iq-card-body p-0" v-else>
                    <div class="media-height p-3">
                        <div class="media align-items-center mb-4">
                            <h6>
                                Start making some friends so they show up in
                                here
                            </h6>
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
            OnlineUser: null
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            this.OnlineUser = res.data;
            Echo.private(`acceptRequest.${this.OnlineUser.id}`).listen(
                "AcceptRequestEvent",
                e => {
                    this.load();
                }
            );
            Echo.private(`acceptRequest2.${this.OnlineUser.id}`).listen(
                "AcceptRequestEvent2",
                e => {
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
                    this.DBfriends = res.data;
                    axios.get("/OnlineUsers").then(res => {
                        var users = res.data;
                        users.forEach(user => {
                            if (this.checkFriend(user.user_id) != null) {
                                var fr = this.checkFriend(user.user_id);
                                var index = this.DBfriends.indexOf(fr);
                                this.DBfriends[index].statu = "status-online";
                                this.DBfriends[index].time = "Online";
                            }
                        });
                        this.friends = this.DBfriends;
                    });

                    Echo.private(`onlineFriend`).listen(
                        "OnlineFriendEvent",
                        e => {
                            if (this.checkOnlineFriend(e.user.id) != null) {
                                var fr = this.checkOnlineFriend(e.user.id);
                                var index = this.friends.indexOf(fr);
                                this.friends[index].statu = "status-online";
                                this.friends[index].time = "Online";
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
                            }
                        }
                    );
                });
        }
    }
};
</script>
