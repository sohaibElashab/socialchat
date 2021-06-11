<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div
                            class="iq-card-header d-flex justify-content-between"
                        >
                            <div class="iq-header-title">
                                <h4 class="card-title">
                                    Friend Request
                                </h4>
                            </div>
                        </div>
                        <div
                            class="iq-card-body"
                            v-if="friendRqs != null && friendRqs.length > 0"
                        >
                            <ul class="request-list list-inline m-0 p-0">
                                <li
                                    class="d-flex align-items-center"
                                    v-for="friendRq in friendRqs"
                                    :key="friendRq.id"
                                >
                                    <div class="user-img img-fluid">
                                        <img
                                            :src="
                                                `images/user/${friendRq.profileimg.name}`
                                            "
                                            alt="story-img"
                                            class="rounded-circle avatar-40"
                                        />
                                    </div>
                                    <div class="media-support-info ml-3">
                                        <h6>{{ friendRq.name }}</h6>
                                        <p class="mb-0">
                                            {{ friendRq.FriendCount }} friends
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button
                                            @click="AcceptRequest(friendRq.id)"
                                            class="mr-3 btn btn-primary rounded"
                                        >
                                            Confirm
                                        </button>
                                        <button
                                            @click="DeleteRequest(friendRq.id)"
                                            class="mr-3 btn btn-secondary rounded"
                                        >
                                            Delete Request
                                        </button>
                                    </div>
                                </li>
                                <li class="d-block text-center" v-if="show">
                                    <a @click="loadAll" class="btn btn-request"
                                        >View More Request</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="iq-card-body" v-else>
                            <div class="request-list list-inline m-0 p-0">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <h6>You have no friend requests</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card">
                        <div
                            class="iq-card-header d-flex justify-content-between"
                        >
                            <div class="iq-header-title">
                                <h4 class="card-title">
                                    People You May Know
                                </h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="request-list m-0 p-0">
                                <li
                                    class="d-flex align-items-center"
                                    v-for="friendKnow in friendKnows"
                                    :key="friendKnow.id"
                                >
                                    <div class="user-img img-fluid">
                                        <img
                                            :src="friendKnow.imgUser"
                                            alt="story-img"
                                            class="rounded-circle avatar-40"
                                        />
                                    </div>
                                    <div class="media-support-info ml-3">
                                        <h6>{{ friendKnow.UserName }}</h6>
                                        <p class="mb-0">
                                            {{ friendKnow.NbrFriend }} friends
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-primary rounded"
                                            ><i class="ri-user-add-line"></i>Add
                                            Friend</a
                                        >
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-secondary rounded"
                                            >Remove</a
                                        >
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
export default {
    data() {
        return {
            friendRqs: null,
            allReqs: null,
            show: true,
            friendKnows: {
                "1": {
                    id: 1,
                    imgUser: "images/user/15.jpg",
                    UserName: "Jaques Amole",
                    NbrFriend: "40"
                },
                "2": {
                    id: 2,
                    imgUser: "images/user/15.jpg",
                    UserName: "Jaques Amole",
                    NbrFriend: "40"
                },
                "3": {
                    id: 3,
                    imgUser: "images/user/15.jpg",
                    UserName: "Jaques Amole",
                    NbrFriend: "40"
                },
                "4": {
                    id: 4,
                    imgUser: "images/user/15.jpg",
                    UserName: "Jaques Amole",
                    NbrFriend: "40"
                }
            }
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            console.log(res.data);
            this.user = res.data;
            this.img = this.user.profileimg.name;
            this.isMounted = true;
            Echo.private(`sendRequest.${this.user.id}`).listen(
                "SendRequestEvent",
                e => {
                    console.log(e.user);
                    this.allReqs.unshift(e.user);
                    this.friendRqs = this.allReqs.slice(0, 4);
                }
            );
            Echo.private(`cancelRequest.${this.user.id}`).listen(
                "CancelRequestEvent",
                e => {
                    console.log(e.user);
                    // console.log(this.allReqs.indexOf(e.user));
                    this.allReqs.forEach(req => {
                        if (req.id === e.user.id) {
                            var index = this.allReqs.indexOf(req);
                            this.allReqs.splice(index, 1);
                            this.friendRqs = this.allReqs.slice(0, 4);
                        }
                    });
                }
            );
            Echo.private(`acceptRequest.${this.user.id}`).listen(
                "AcceptRequestEvent",
                e => {
                    console.log(e.user);
                    // console.log(this.allReqs.indexOf(e.user));
                    this.allReqs.forEach(req => {
                        if (req.id === e.user.id) {
                            var index = this.allReqs.indexOf(req);
                            this.allReqs.splice(index, 1);
                            this.friendRqs = this.allReqs.slice(0, 4);
                        }
                    });
                }
            );
        });
        axios.get("/LoadRequests").then(res => {
            console.log(res.data);
            this.allReqs = res.data;
            this.friendRqs = this.allReqs.slice(0, 4);
        });
    },
    methods: {
        DeleteRequest(id) {
            axios
                .post("/DeleteReq", {
                    id: id
                })
                .then(res => {
                    console.log(res);
                    axios.get("/LoadRequests").then(res => {
                        console.log(res.data);
                        this.allReqs = res.data;
                        this.friendRqs = this.allReqs.slice(0, 4);
                        this.show = true;
                    });
                });
        },
        AcceptRequest(id) {
            axios
                .post("/AcceptRequest", {
                    id: id
                })
                .then(res => {
                    console.log(res);
                    axios.get("/LoadRequests").then(res => {
                        console.log(res.data);
                        this.allReqs = res.data;
                        this.friendRqs = this.allReqs.slice(0, 4);
                        this.show = true;
                    });
                });
        },
        loadAll() {
            this.friendRqs = this.allReqs;
            this.show = false;
        }
    }
};
</script>
