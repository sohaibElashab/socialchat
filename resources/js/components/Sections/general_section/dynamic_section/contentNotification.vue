<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div
                        class="iq-card-header d-flex justify-content-between"
                    >
                        <div class="iq-header-title">
                            <h4 class="card-title">Notification</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="iq-card" v-for="notification in notifications" :key="notification.id">
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
                                    <div
                                        class="media-support-info ml-3"
                                    >
                                        <h6>
                                            <router-link to="/" tag="a"> {{notification.userName }} </router-link>
                                            {{notification.WhatDo}}
                                        </h6>
                                        <p class="mb-0">{{notification.time}} ago</p>
                                    </div>
                                    <div
                                        class="d-flex align-items-center"
                                    >
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 iq-notify rounded"
                                            :class="notification.type == post ? 'iq-bg-primary' : notification.type == like ? 'iq-bg-danger' : notification.type == comment ? 'iq-bg-success' : notification.type == request ? 'iq-bg-warning' : notification.type == share ? 'iq-bg-info' : ''"
                                            ><i
                                                :class="notification.type == post ? 'ri-award-line' : notification.type == like ? 'ri-heart-line' : notification.type == comment ? 'ri-chat-4-line' : notification.type == request ? 'ri-reply-line' : notification.type == share ? 'ri-share-line' : ''"
                                            ></i
                                        ></a>
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 iq-notify rounded"
                                            :class="notification.type == post ? 'iq-bg-primary' : notification.type == like ? 'iq-bg-danger' : notification.type == comment ? 'iq-bg-success' : notification.type == request ? 'iq-bg-warning' : notification.type == share ? 'iq-bg-info' : ''"
                                            ><i
                                                class="ri-eye-fill"
                                            ></i
                                        ></a>
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 iq-notify rounded"
                                            :class="notification.type == post ? 'iq-bg-primary' : notification.type == like ? 'iq-bg-danger' : notification.type == comment ? 'iq-bg-success' : notification.type == request ? 'iq-bg-warning' : notification.type == share ? 'iq-bg-info' : ''"
                                            ><i
                                                class="ri-delete-bin-6-fill"
                                            ></i
                                        ></a>
                                    </div>
                                </li>
                            </ul>
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
        ProfileFriend,
    },
    data() {
        return {
            post : "post",
            like : "like",
            comment : "comment",
            share : "share",
            request : "request",
            notifications: {
                "1": {
                    id: 1,
                    userImg: "images/user/14.jpg",
                    userName: "Petey Cruiser",
                    WhatDo: "Posted in his profile",
                    time: "30s",
                    type: "post"
                },
                "2": {
                    id: 2,
                    userImg: "images/user/13.jpg",
                    userName: "Petey Cruiser",
                    WhatDo: "Like Your Post / comment ",
                    time: "1min",
                    type: "like"
                },
                "3": {
                    id: 3,
                    userImg: "images/user/12.jpg",
                    userName: "Petey Cruiser",
                    WhatDo: "commented on your post ",
                    time: "5min",
                    type: "comment"
                },
                "4": {
                    id: 4,
                    userImg: "images/user/11.jpg",
                    userName: "Petey Cruiser",
                    WhatDo: "Sent a Friend Request",
                    time: "1H",
                    type: "request"
                },
                "5": {
                    id: 5,
                    userImg: "images/user/10.jpg",
                    userName: "Petey Cruiser",
                    WhatDo: "share Your Post",
                    time: "2H",
                    type: "share"
                }
            },
        };
    }
};
</script>
