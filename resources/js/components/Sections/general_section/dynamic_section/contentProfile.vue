<template>
    <div id="content-page" class="content-page">
        <div class="container" v-if="user">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header">
                                <div
                                    class="cover-container"
                                    style="height: 250px;"
                                >
                                    <img
                                        :src="
                                            `images/user/${user.coverimg.name}`
                                        "
                                        alt="profile-bg"
                                        style="position: relative; width: 100%; height: 100%;"
                                        class="rounded img-fluid"
                                    />
                                    <ul
                                        class="header-nav d-flex flex-wrap justify-end p-0 m-0"
                                    >
                                        <li style="z-index:1">
                                            <router-link
                                                to="/profileEdit"
                                                tag="a"
                                                v-if="user.status == 'current'"
                                                ><i class="ri-pencil-line"></i
                                            ></router-link>
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-detail text-center mb-3">
                                    <div class="profile-img">
                                        <!-- 11.png // -->
                                        <img
                                            :src="
                                                `images/user/${user.profileimg.name}`
                                            "
                                            alt="profile-img"
                                            class="avatar-130 img-fluid"
                                        />
                                    </div>
                                    <div class="profile-detail">
                                        <h3 class="">
                                            {{ user.name }}
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    class="profile-info p-4 d-flex align-items-center justify-content-between position-relative"
                                >
                                    <div class="social-links">
                                        <ul
                                            class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0"
                                        >
                                            <li class="text-center pr-3">
                                                <a :href="user.facebook"
                                                    ><img
                                                        src="images/icon/08.png"
                                                        class="img-fluid rounded"
                                                        alt="facebook"
                                                /></a>
                                            </li>
                                            <li class="text-center pr-3">
                                                <a :href="user.twitter"
                                                    ><img
                                                        src="images/icon/09.png"
                                                        class="img-fluid rounded"
                                                        alt="Twitter"
                                                /></a>
                                            </li>
                                            <li class="text-center pr-3">
                                                <a :href="user.instagram"
                                                    ><img
                                                        src="images/icon/10.png"
                                                        class="img-fluid rounded"
                                                        alt="Instagram"
                                                /></a>
                                            </li>

                                            <li class="text-center pr-3">
                                                <a :href="user.youtube"
                                                    ><img
                                                        src="images/icon/12.png"
                                                        class="img-fluid rounded"
                                                        alt="You tube"
                                                /></a>
                                            </li>
                                            <li class="text-center pr-3">
                                                <a :href="user.linkedin"
                                                    ><img
                                                        src="images/icon/13.png"
                                                        class="img-fluid rounded"
                                                        alt="linkedin"
                                                /></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="social-info">
                                        <ul
                                            class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0"
                                        >
                                            <li class="text-center pl-3">
                                                <h6>Friends</h6>
                                                <p class="mb-0">206</p>
                                            </li>
                                            <li class="text-center pl-3">
                                                <h6>Posts</h6>
                                                <p class="mb-0">6</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card" v-if="message != 'current'">
                        <div class="iq-card-body p-0">
                            <div class="user-tabing">
                                <div
                                    class="d-flex align-items-center p-0 m-0 flex-column flex-md-row"
                                >
                                    <div
                                        class="col-md-8 col-sm-12 p-4"
                                        v-if="message == 'friend'"
                                    >
                                        <div>
                                            <h4>
                                                You are friend with
                                                {{ user.name }}
                                            </h4>
                                        </div>
                                        <div>
                                            <span
                                                >You can now see what
                                                {{ user.name }} is sharing, Send
                                                him a message and have fun</span
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12 p-4" v-else>
                                        <div>
                                            <h4>
                                                Do you know {{ user.name }}?
                                            </h4>
                                        </div>
                                        <div>
                                            <span
                                                >To see what she shares with
                                                friends, send her a friend
                                                request.</span
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 p-4">
                                        <div
                                            class="text-center pl-3"
                                            v-if="message == 'cancel'"
                                        >
                                            <button
                                                class="mr-3 btn btn-danger rounded"
                                                @click="DeleteRequest"
                                            >
                                                <i
                                                    class="ri-user-shared-line mr-1 text-white font-size-16"
                                                ></i>
                                                Cancel request
                                            </button>
                                        </div>
                                        <div
                                            class="text-center pl-3"
                                            v-else-if="message == 'accept'"
                                        >
                                            <button
                                                class="mr-3 btn btn-primary rounded"
                                                @click="AcceptRequest"
                                            >
                                                <i
                                                    class="ri-user-follow-line mr-1 text-white font-size-16"
                                                ></i>
                                                Accept request
                                            </button>
                                        </div>
                                        <div
                                            class="text-center pl-3"
                                            v-else-if="message == ''"
                                        >
                                            <button
                                                class="mr-3 btn btn-primary rounded"
                                                @click="sendRequest"
                                            >
                                                <i class="ri-user-add-line"></i
                                                >Add Friend
                                            </button>
                                        </div>
                                        <div
                                            class="text-center pl-3"
                                            v-else-if="message == 'friend'"
                                        >
                                            <router-link
                                                :to="{
                                                    name: 'chat',
                                                    query: { user: user.id }
                                                }"
                                                class="mr-3 btn btn-success rounded"
                                            >
                                                <i
                                                    class="ri-mail-send-line text-white font-size-16"
                                                ></i>
                                                Message
                                            </router-link>
                                            <button
                                                class="mr-3 btn btn-danger rounded"
                                                @click="RemoveFriend"
                                            >
                                                <i
                                                    class="ri-user-unfollow-line mr-1 text-white font-size-16"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="user-tabing">
                                <ul
                                    class="nav nav-pills d-flex align-items-center justify-content-center profile-feed-items p-0 m-0"
                                >
                                    <li class="col-sm-3 p-0">
                                        <a
                                            class="nav-link active"
                                            data-toggle="pill"
                                            href="#timeline"
                                            >Timeline</a
                                        >
                                    </li>
                                    <li class="col-sm-3 p-0">
                                        <a
                                            class="nav-link"
                                            data-toggle="pill"
                                            href="#about"
                                            >About</a
                                        >
                                    </li>
                                    <li class="col-sm-3 p-0">
                                        <a
                                            class="nav-link"
                                            data-toggle="pill"
                                            href="#friends"
                                            >friends</a
                                        >
                                    </li>
                                    <li class="col-sm-3 p-0">
                                        <a
                                            class="nav-link"
                                            data-toggle="pill"
                                            href="#photos"
                                            >Photos</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active show"
                            id="timeline"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="iq-card">
                                            <div
                                                class="iq-card-header d-flex justify-content-between"
                                            >
                                                <div class="iq-header-title">
                                                    <h4 class="card-title">
                                                        Intro
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div
                                                            class="event-post position-relative"
                                                        >
                                                            <p>
                                                                <i
                                                                    class="las la-home"
                                                                ></i>
                                                                <strong>
                                                                    Lives in
                                                                </strong>
                                                                {{
                                                                    user.adress
                                                                }}
                                                            </p>
                                                            <p>
                                                                <i
                                                                    class="las la-birthday-cake"
                                                                ></i>
                                                                <strong>
                                                                    Birthday is
                                                                    on
                                                                </strong>
                                                                {{
                                                                    new Date(
                                                                        user.birth_date
                                                                    ).getDate()
                                                                }}
                                                                {{
                                                                    new Date(
                                                                        user.birth_date
                                                                    ).toLocaleString(
                                                                        "default",
                                                                        {
                                                                            month:
                                                                                "long"
                                                                        }
                                                                    )
                                                                }}
                                                            </p>
                                                            <p>
                                                                <i
                                                                    class="las la-phone"
                                                                ></i>
                                                                <strong>
                                                                    Your number
                                                                    is
                                                                </strong>
                                                                {{
                                                                    user.mobile
                                                                }}
                                                            </p>
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
                                                        Photos
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <ul
                                                    class="profile-img-gallary d-flex flex-wrap p-0 m-0"
                                                >
                                                    <li
                                                        class="col-md-4 col-6 pl-2 pr-0 pb-3"
                                                        v-for="image in images"
                                                        :key="image.id"
                                                    >
                                                        <a
                                                            href="javascript:void();"
                                                        >
                                                            <img
                                                                :src="
                                                                    image.name
                                                                "
                                                                alt="gallary-image"
                                                                class="img-fluid"
                                                            />
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="iq-card">
                                            <div
                                                class="iq-card-header d-flex justify-content-between"
                                            >
                                                <div class="iq-header-title">
                                                    <h4 class="card-title">
                                                        Friends
                                                    </h4>
                                                </div>
                                                <div
                                                    class="iq-card-header-toolbar d-flex align-items-center"
                                                >
                                                    <p class="m-0">
                                                        <a
                                                            href="javacsript:void();"
                                                            >Add New
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <ul
                                                    class="profile-img-gallary d-flex flex-wrap p-0 m-0"
                                                >
                                                    <li
                                                        class="col-md-4 col-6 pl-2 pr-0 pb-3"
                                                        v-for="(FriendList,
                                                        index) in FriendLists"
                                                        :key="index"
                                                    >
                                                        <div v-if="index < 9">
                                                            <router-link
                                                                :to="{
                                                                    name:
                                                                        'profile',

                                                                    query: {
                                                                        user:
                                                                            FriendList.id
                                                                    }
                                                                }"
                                                                tag="a"
                                                            >
                                                                <img
                                                                    :src="
                                                                        `images/user/${FriendList.profileimg.name}`
                                                                    "
                                                                    alt="gallary-image"
                                                                    class="img-fluid"
                                                                />
                                                            </router-link>
                                                            <h6
                                                                class="mt-2 text-center"
                                                            >
                                                                {{
                                                                    FriendList.name
                                                                }}
                                                            </h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <CreatePost
                                            v-if="user.status == 'current'"
                                        />
                                        <Post
                                            v-for="post in posts"
                                            :key="post.id"
                                            :post="post"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- about user -->
                        <ProfileAbout :user="user" />
                        <!-- friend lists -->
                        <ProfileFriend
                            :Id="user.id"
                            :IdOnline="OnlineUser.id"
                            :status="user.status"
                            ref="friends"
                            v-if="loaded"
                        />
                        <!-- photo galery -->
                        <ProfileImages :UserId="user.id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileFriend from "../../single_section/ProfileFriend";
import ProfileAbout from "../../single_section/ProfileAbout";
import ProfileImages from "../../single_section/ProfileImages";
import CreatePost from "../../single_section/CreatePost";
import Post from "../../single_section/Post";
export default {
    components: {
        ProfileFriend,
        ProfileImages,
        CreatePost,
        Post,
        ProfileAbout
    } /* 
    props: ["UserId"], */,
    data() {
        return {
            date: null,
            user: null,
            OnlineUser: null,
            message: "",
            FriendLists: null,
            loaded: false,
            images: [],
            posts: null,
            postss: {
                "1": {
                    id: 1,
                    userImg: "images/user/01.jpg",
                    userName: "Anna Sthesia",
                    statu: "Add New Post",
                    time: "Just Now",
                    text:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                    postImgs: [
                        { img: "images/page-img/p1.jpg" },
                        { img: "images/page-img/p2.jpg" },
                        { img: "images/page-img/p3.jpg" }
                    ],
                    postVds: []
                },
                "2": {
                    id: 2,
                    userImg: "images/user/03.jpg",
                    userName: "Barb Ackue",
                    statu: "Added New Image in a Post",
                    time: "1 hour ago",
                    text:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                    postImgs: [{ img: "images/page-img/p4.jpg" }],
                    postVds: []
                },
                "3": {
                    id: 3,
                    userImg: "images/user/04.jpg",
                    userName: "Ira Membrit",
                    statu: "Update her Status",
                    time: "6 hour ago",
                    text:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                    postImgs: {},
                    postVds: []
                },
                "4": {
                    id: 4,
                    userImg: "images/user/01.jpg",
                    userName: "Bni Cyst",
                    statu: "Changed Profile Picture",
                    time: "3 day ago",
                    text: "",
                    postImgs: [{ img: "images/page-img/p5.jpg" }],
                    postVds: []
                },
                "5": {
                    id: 5,
                    userImg: "images/user/02.jpg",
                    userName: "Paige Turner",
                    statu: "Added New Video in his Timeline",
                    time: "1 day ago",
                    text:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                    postImgs: {},
                    postVds: [{ vd: "images/page-img/vd.mp4" }]
                }
            }
        };
    },
    mounted() {
        /*   if (this.UserId != null) {
            sessionStorage.clear();
            sessionStorage.setItem("id", this.UserId);
        } */
        this.load();
        this.imagesLoad();
        this.friendLoad();
        this.LoadPosts();
    },
    methods: {
        LoadPosts() {
            axios
                .post("/UserPosts", {
                    id: this.$route.query.user
                })
                .then(res => {
                    this.posts = res.data;
                });
        },
        load() {
            axios
                .post("/UserProfile", {
                    id: this.$route.query.user
                })
                .then(res => {
                    console.log(res.data);
                    this.user = res.data;
                    if (this.user.message != undefined) {
                        this.message = this.user.message;
                    } else {
                        this.message = "";
                    }
                    /*  Echo.private(`cancelRequest.${this.user.id}`).listen(
                        "CancelRequestEvent",
                        e => {
                            console.log(e.user.name);
                            if (this.user.status == "friend") {
                                this.message = "";
                            }
                        }
                    ); */

                    /*  Echo.private(`sendRequest.${this.user.id}`).listen(
                        "SendRequestEvent",
                        e => {
                            // console.log(e.user);
                            //console.log("accept");
                            this.message = "accept";
                        }
                    ); */

                    /* Echo.private(`acceptRequest.${this.user.id}`).listen(
                        "AcceptRequestEvent",
                        e => {
                            //console.log(e.user.name);
                            if (this.user.status == "friend") {
                                this.message = "friend";
                            }
                        }
                    ); */
                });

            axios.get("/profile").then(res => {
                this.OnlineUser = res.data;
                this.loaded = true;
                Echo.private(`cancelRequest.${this.OnlineUser.id}`).listen(
                    "CancelRequestEvent",
                    e => {
                        //console.log(e.user.name);
                        /*  if (this.user.status == "friend") {
                            } */
                        this.message = "";
                    }
                );

                Echo.private(`sendRequest.${this.OnlineUser.id}`).listen(
                    "SendRequestEvent",
                    e => {
                        if (this.$route.query.user == e.user.id) {
                            this.message = "accept";
                        }
                    }
                );

                Echo.private(`acceptRequest.${this.OnlineUser.id}`).listen(
                    "AcceptRequestEvent",
                    e => {
                        //console.log(e.user.name);
                        /*    if (this.user.status == "friend") {
                            } */
                        this.message = "friend";
                    }
                );
            });
        },
        sendRequest() {
            axios
                .post("/SendRequest", {
                    id: this.user.id
                })
                .then(res => {
                    console.log(res.data);
                    this.message = "cancel";
                    //console.log(this.message);
                });
        },
        DeleteRequest() {
            axios
                .post("/DeleteRequest", {
                    id: this.user.id
                })
                .then(res => {
                    console.log(res);
                    this.message = "";
                });
        },
        AcceptRequest() {
            axios
                .post("/AcceptRequest", {
                    id: this.user.id
                })
                .then(res => {
                    console.log(res);
                    this.message = "friend";
                    /*    var child = this.$refs.friends;
                    child.LoadFriends(); */
                });
        },
        RemoveFriend() {
            axios
                .post("/RemoveFriend", {
                    id: this.user.id
                })
                .then(res => {
                    console.log(res);
                    this.message = "";
                    var child = this.$refs.friends;
                    child.LoadFriends();
                });
        },
        imagesLoad() {
            axios.post("/ProfileImages", { id: this.UserId }).then(res => {
                this.images = res.data;
            });
            console.log("yay");
        },
        friendLoad() {
            axios
                .post("/LoadFriends", {
                    id: this.$route.query.user
                })
                .then(res => {
                    console.log(res.data);
                    this.FriendLists = res.data;
                });
        }
    },
    watch: {
        "$route.query.user": function() {
            /*      if (this.UserId != null) {
                sessionStorage.clear();
                sessionStorage.setItem("id", this.user.id);
                // console.log("profile content watch");
            } */
            this.load();
            this.friendLoad();
            this.imagesLoad();
            this.LoadPosts();
        }
    }
};
</script>
