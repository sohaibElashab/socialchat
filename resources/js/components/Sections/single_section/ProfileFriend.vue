<template>
    <div class="tab-pane fade" id="friends" role="tabpanel">
        <div class="iq-card">
            <div class="iq-card-body">
                <h2>Friends</h2>
                <div
                    class="friend-list-tab mt-2"
                    v-if="
                        FriendLists != null &&
                            FriendLists.length > 0 &&
                            status == 'current'
                    "
                >
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active show"
                            id="all-friends"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-md-6 col-lg-6 mb-3"
                                        v-for="FriendList in FriendLists"
                                        :key="FriendList.id"
                                    >
                                        <div class="iq-friendlist-block">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <router-link
                                                        :to="{
                                                            name: 'profile',
                                                            query: {
                                                                user:
                                                                    FriendList.id
                                                            }
                                                        }"
                                                        tag="a"
                                                    >
                                                        <a>
                                                            <img
                                                                :src="
                                                                    `images/user/${FriendList.profileimg.name}`
                                                                "
                                                                alt="profile-img"
                                                                style="width: 150px ; height: 150px;"
                                                            />
                                                        </a>
                                                    </router-link>
                                                    <div
                                                        class="friend-info ml-3"
                                                    >
                                                        <h5>
                                                            {{
                                                                FriendList.name
                                                            }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{
                                                                FriendList.FriendCount
                                                            }}
                                                            friends
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <div
                                                        v-if="
                                                            status == 'current'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-2 btn btn-danger"
                                                            @click="
                                                                RemoveFriend(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-check-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Unfriend
                                                        </button>
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
                <div
                    class="friend-list-tab mt-2"
                    v-else-if="
                        FriendLists != null &&
                            FriendLists.length > 0 &&
                            status != 'current'
                    "
                >
                    <ul
                        class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2"
                    >
                        <li>
                            <a
                                class="nav-link active"
                                data-toggle="pill"
                                href="#all-friends"
                                >All Friends</a
                            >
                        </li>
                        <li>
                            <a
                                class="nav-link"
                                data-toggle="pill"
                                href="#recently-add"
                                >Friends In Common</a
                            >
                        </li>
                        <li>
                            <a
                                class="nav-link"
                                data-toggle="pill"
                                href="#closefriends"
                                >Other friends</a
                            >
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active show"
                            id="all-friends"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-md-6 col-lg-6 mb-3"
                                        v-for="FriendList in FriendLists"
                                        :key="FriendList.id"
                                    >
                                        <div class="iq-friendlist-block">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <router-link
                                                        :to="{
                                                            name: 'profile',
                                                            query: {
                                                                user:
                                                                    FriendList.id
                                                            }
                                                        }"
                                                        tag="a"
                                                    >
                                                        <a>
                                                            <img
                                                                :src="
                                                                    `images/user/${FriendList.profileimg.name}`
                                                                "
                                                                alt="profile-img"
                                                                style="width: 150px ; height: 150px;"
                                                            />
                                                        </a>
                                                    </router-link>
                                                    <div
                                                        class="friend-info ml-3"
                                                    >
                                                        <h5>
                                                            {{
                                                                FriendList.name
                                                            }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{
                                                                FriendList.FriendCount
                                                            }}
                                                            friends
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <div
                                                        v-if="
                                                            FriendList.button ==
                                                                'remove'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-2 btn btn-danger"
                                                            @click="
                                                                RemoveFriend(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-check-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Unfriend
                                                        </button>
                                                    </div>
                                                    <div
                                                        v-else-if="
                                                            FriendList.button ==
                                                                'add'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-2 btn btn-primary"
                                                            @click="
                                                                sendRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-add-line"
                                                            ></i>
                                                            Add friend
                                                        </button>
                                                    </div>
                                                    <div
                                                        v-else-if="
                                                            FriendList.button ==
                                                                'accept'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-3 btn btn-primary rounded"
                                                            @click="
                                                                AcceptRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-follow-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Accept request
                                                        </button>
                                                    </div>
                                                    <div
                                                        v-else-if="
                                                            FriendList.button ==
                                                                'cancel'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-3 btn btn-danger rounded"
                                                            @click="
                                                                DeleteRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-shared-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Cancel request
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="recently-add"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-md-6 col-lg-6 mb-3"
                                        v-for="FriendList in InCommon"
                                        :key="FriendList.id"
                                    >
                                        <div class="iq-friendlist-block">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <router-link
                                                        :to="{
                                                            name: 'profile',
                                                            query: {
                                                                user:
                                                                    FriendList.id
                                                            }
                                                        }"
                                                        tag="a"
                                                    >
                                                        <a>
                                                            <img
                                                                :src="
                                                                    `images/user/${FriendList.profileimg.name}`
                                                                "
                                                                alt="profile-img"
                                                                style="width: 150px ; height: 150px;"
                                                            />
                                                        </a>
                                                    </router-link>
                                                    <div
                                                        class="friend-info ml-3"
                                                    >
                                                        <h5>
                                                            {{
                                                                FriendList.name
                                                            }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{
                                                                FriendList.FriendCount
                                                            }}
                                                            friends
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <div>
                                                        <button
                                                            class="mr-2 btn btn-danger"
                                                            @click="
                                                                RemoveFriend(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-check-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Unfriend
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="closefriends"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-md-6 col-lg-6 mb-3"
                                        v-for="FriendList in Others"
                                        :key="FriendList.id"
                                    >
                                        <div class="iq-friendlist-block">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <router-link
                                                        :to="{
                                                            name: 'profile',
                                                            query: {
                                                                user:
                                                                    FriendList.id
                                                            }
                                                        }"
                                                        tag="a"
                                                    >
                                                        <a>
                                                            <img
                                                                :src="
                                                                    `images/user/${FriendList.profileimg.name}`
                                                                "
                                                                alt="profile-img"
                                                                style="width: 150px ; height: 150px;"
                                                            />
                                                        </a>
                                                    </router-link>
                                                    <div
                                                        class="friend-info ml-3"
                                                    >
                                                        <h5>
                                                            {{
                                                                FriendList.name
                                                            }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{
                                                                FriendList.FriendCount
                                                            }}
                                                            friends
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <div
                                                        v-if="
                                                            FriendList.button ==
                                                                'accept'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-3 btn btn-primary rounded"
                                                            @click="
                                                                AcceptRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-follow-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Accept request
                                                        </button>
                                                    </div>
                                                    <div
                                                        v-else-if="
                                                            FriendList.button ==
                                                                'cancel'
                                                        "
                                                    >
                                                        <button
                                                            class="mr-3 btn btn-danger rounded"
                                                            @click="
                                                                DeleteRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-shared-line mr-1 text-white font-size-16"
                                                            ></i>
                                                            Cancel request
                                                        </button>
                                                    </div>
                                                    <div v-else>
                                                        <button
                                                            class="mr-2 btn btn-primary"
                                                            @click="
                                                                sendRequest(
                                                                    FriendList.id
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="ri-user-add-line"
                                                            ></i>
                                                            Add friend
                                                        </button>
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
                <div class="friend-list-tab mt-2" v-else>
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active show"
                            id="all-friends"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <div class="iq-friendlist-block">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <div
                                                        v-if="
                                                            status == 'current'
                                                        "
                                                    >
                                                        Start making some
                                                        friends so they show up
                                                        in here
                                                    </div>
                                                    <div v-else>
                                                        Send them friend a
                                                        request and be their
                                                        first friend
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        Id: {
            type: Number,
            require: true
        },
        IdOnline: {
            type: Number,
            require: true
        },
        status: {
            type: String
        }
    },
    data() {
        return {
            FriendLists: null,
            InCommon: null,
            Others: null
        };
    },
    mounted() {
        this.LoadFriends();
        Echo.private(`acceptRequest.${this.Id}`).listen(
            "AcceptRequestEvent",
            e => {
                this.LoadFriends();
            }
        );
        Echo.private(`acceptRequest2.${this.Id}`).listen(
            "AcceptRequestEvent2",
            e => {
                this.LoadFriends();
            }
        );

        Echo.private(`acceptRequest.${this.IdOnline}`).listen(
            "AcceptRequestEvent",
            e => {
                this.LoadFriends();
            }
        );
        Echo.private(`acceptRequest2.${this.IdOnline}`).listen(
            "AcceptRequestEvent2",
            e => {
                this.LoadFriends();
            }
        );
        Echo.private(`sendRequest.${this.IdOnline}`).listen(
            "SendRequestEvent",
            e => {
                this.LoadFriends();
            }
        );
        Echo.private(`cancelRequest.${this.IdOnline}`).listen(
            "CancelRequestEvent",
            e => {
                this.LoadFriends();
            }
        );
    },
    methods: {
        DeleteRequest(id) {
            axios
                .post("/DeleteRequest", {
                    id: id
                })
                .then(res => {
                    this.LoadFriends();
                });
        },
        AcceptRequest(id) {
            axios
                .post("/AcceptRequest", {
                    id: id
                })
                .then(res => {
                    this.LoadFriends();
                });
        },
        sendRequest(id) {
            axios
                .post("/SendRequest", {
                    id: id
                })
                .then(res => {
                    //
                    this.LoadFriends();
                });
        },
        RemoveFriend(id) {
            axios
                .post("/RemoveFriend", {
                    id: id
                })
                .then(res => {
                    this.LoadFriends();
                });
        },
        LoadFriends() {
            axios
                .post("/LoadFriends", {
                    id: this.Id
                })
                .then(res => {
                    //
                    this.FriendLists = res.data;
                });

            if (this.status != "current") {
                axios
                    .post("/FriendsInCommon", {
                        id: this.Id
                    })
                    .then(res => {
                        //
                        this.InCommon = res.data[0];
                        this.Others = res.data[1];
                    });
            }

            //document.getElementById("New").style.display = "none";
        }
    },
    watch: {
        Id: function() {
            this.LoadFriends();
        }
    }
};
</script>
