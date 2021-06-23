<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Notifications</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" v-if="notifications.length > 0">
                    <div
                        class="iq-card"
                        v-for="notification in notifications"
                        :key="notification.id"
                    >
                        <div class="iq-card-body">
                            <ul class="notification-list m-0 p-0">
                                <li class="d-flex align-items-center">
                                    <div class="user-img img-fluid">
                                        <img
                                            :src="notification.userImg"
                                            alt="story-img"
                                            class="rounded-circle avatar-40"
                                        />
                                    </div>
                                    <div class="media-support-info ml-3">
                                        <h6>
                                            <router-link
                                                :to="{
                                                    name: 'profile',
                                                    query: {
                                                        user:
                                                            notification.userId
                                                    }
                                                }"
                                                tag="a"
                                            >
                                                {{ notification.userName }}
                                            </router-link>
                                            {{ notification.WhatDo }}
                                        </h6>
                                        <p
                                            class="mb-0"
                                            v-if="
                                                notification.time == 'Just Now'
                                            "
                                        >
                                            {{ notification.time }}
                                        </p>
                                        <p class="mb-0" v-else>
                                            {{ notification.time }} ago
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a
                                            class="mr-3 iq-notify rounded"
                                            :class="
                                                notification.type == post
                                                    ? 'iq-bg-primary'
                                                    : notification.type ==
                                                      like_post
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      like_comment
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      comment
                                                    ? 'iq-bg-success'
                                                    : notification.type ==
                                                      request
                                                    ? 'iq-bg-warning'
                                                    : notification.type == share
                                                    ? 'iq-bg-info'
                                                    : ''
                                            "
                                            ><i
                                                :class="
                                                    notification.type == post
                                                        ? 'ri-award-line'
                                                        : notification.type ==
                                                          like_post
                                                        ? 'ri-heart-line'
                                                        : notification.type ==
                                                          like_comment
                                                        ? 'ri-heart-line'
                                                        : notification.type ==
                                                          comment
                                                        ? 'ri-chat-4-line'
                                                        : notification.type ==
                                                          request
                                                        ? 'ri-reply-line'
                                                        : notification.type ==
                                                          share
                                                        ? 'ri-share-line'
                                                        : ''
                                                "
                                            ></i
                                        ></a>
                                        <router-link
                                            v-if="notification.type == request"
                                            to="/friendRequest"
                                            tag="a"
                                            class="mr-3 iq-notify rounded"
                                            :class="
                                                notification.type == post
                                                    ? 'iq-bg-primary'
                                                    : notification.type ==
                                                      like_post
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      like_comment
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      comment
                                                    ? 'iq-bg-success'
                                                    : notification.type ==
                                                      request
                                                    ? 'iq-bg-warning'
                                                    : notification.type == share
                                                    ? 'iq-bg-info'
                                                    : ''
                                            "
                                            ><i class="ri-eye-fill"></i
                                        ></router-link>
                                        <!-- post?postId=7 -->
                                        <router-link
                                            v-else-if="
                                                notification.type != request
                                            "
                                            :to="{
                                                name: 'post',
                                                query: {
                                                    postId: notification.post_id
                                                }
                                            }"
                                            tag="a"
                                            class="mr-3 iq-notify rounded"
                                            :class="
                                                notification.type == post
                                                    ? 'iq-bg-primary'
                                                    : notification.type ==
                                                      like_post
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      like_comment
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      comment
                                                    ? 'iq-bg-success'
                                                    : notification.type ==
                                                      request
                                                    ? 'iq-bg-warning'
                                                    : notification.type == share
                                                    ? 'iq-bg-info'
                                                    : ''
                                            "
                                            ><i class="ri-eye-fill"></i
                                        ></router-link>
                                        <a
                                            style="cursor:pointer"
                                            @click="deleteNotif(notification)"
                                            class="mr-3 iq-notify rounded"
                                            :class="
                                                notification.type == post
                                                    ? 'iq-bg-primary'
                                                    : notification.type ==
                                                      like_post
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      like_comment
                                                    ? 'iq-bg-danger'
                                                    : notification.type ==
                                                      comment
                                                    ? 'iq-bg-success'
                                                    : notification.type ==
                                                      request
                                                    ? 'iq-bg-warning'
                                                    : notification.type == share
                                                    ? 'iq-bg-info'
                                                    : ''
                                            "
                                            ><i class="ri-delete-bin-6-fill"></i
                                        ></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" v-else>
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header-image">
                                <div class="profile-info p-4">
                                    <div class="user-detail">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-start"
                                        >
                                            <h6>
                                                You have no Notifications
                                            </h6>
                                            <router-link
                                                to="/"
                                                tag="h6"
                                                style="cursor: pointer;"
                                                >Back to home</router-link
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileFriend from "../../single_section/ProfileFriend";
export default {
    components: {
        ProfileFriend
    },
    data() {
        return {
            friends: null,
            post: "post",
            like_post: "like_post",
            like_comment: "like_comment",
            comment: "comment",
            share: "share",
            request: "request",
            notifications: []
        };
    },
    mounted() {
        this.load();
        axios
            .get("/profile")
            .then(res => {
                Echo.private(`Notification.${res.data.id}`).listen(
                    "NotificationEvent",
                    e => {
                        console.log("e.notif");
                        console.log(e.notif);
                        this.notifications.unshift(e.notif);
                    }
                );
            })
            .catch(err => {
                console.log(err);
            });

        Echo.private(`newPost`).listen("NewPostEvent", e => {
            if (this.checkFriend(e.post.user_id) != null) {
                var notif = {
                    WhatDo: "Posted in his profile",
                    type: "post",
                    time: "Just Now",
                    userImg: "images/user/" + e.post.userImg,
                    userName: e.post.userName,
                    userId: e.post.userId,
                    post_id: e.post.id
                };
                this.notifications.unshift(notif);
            }
        });
    },
    methods: {
        checkFriend(id) {
            var p = null;

            this.friends.forEach(friend => {
                console.log(friend);
                if (friend.id == id) {
                    p = friend;
                    return true;
                }
            });
            return p;
        },
        load() {
            axios.get("/LoadNotif").then(res => {
                //console.log(res.data);
                this.notifications = res.data;
            });
            axios
                .post("/LoadFriends", {
                    id: null
                })
                .then(res => {
                    this.friends = res.data;
                });
        },
        deleteNotif(notif) {
            axios
                .post("/DeleteNotif", {
                    id: notif.id
                })
                .then(res => {
                    var index = this.notifications.indexOf(notif);
                    this.notifications.splice(index, 1);
                });
        }
    }
};
</script>
