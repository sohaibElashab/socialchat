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
                                                <p class="mb-0">
                                                    {{ user.FriendCount }}
                                                </p>
                                            </li>
                                            <li class="text-center pl-3">
                                                <h6>Posts</h6>
                                                <p class="mb-0">
                                                    {{ user.PostCount }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card" v-if="user.status != 'current'">
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
                                                            <p
                                                                v-if="
                                                                    user.adress &&
                                                                        user.adress !=
                                                                            'null'
                                                                "
                                                            >
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
                                                        v-for="image in introImages"
                                                        :key="image.id"
                                                    >
                                                        <router-link
                                                            tag="a"
                                                            :to="{
                                                                name: 'post',
                                                                query: {
                                                                    postId:
                                                                        image.post_id
                                                                }
                                                            }"
                                                        >
                                                            <img
                                                                :src="
                                                                    `images/posts/${user.id}/${image.name}`
                                                                "
                                                                alt="gallary-image"
                                                                class="img-fluid"
                                                            />
                                                        </router-link>
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
                                            @newPost="newPost"
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
                            @changeCount="changeCount"
                            v-if="loaded"
                        />
                        <!-- photo galery -->
                        <ProfileImages
                            :images="images"
                            :id="OnlineUser.id"
                            v-if="loaded"
                        />
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
            introImages: [],
            posts: [],
        };
    },
    mounted() {
        /*   if (this.UserId != null) {
            sessionStorage.clear();
            sessionStorage.setItem("id", this.UserId);
        } */
        Echo.private(`newPost`).listen("NewPostEvent", e => {
            if (e.post.user_id == this.$route.query.user) {
                this.posts.unshift(e.post);
            }
        });
        this.introImages = [];
        this.load();
        this.imagesLoad();
        this.friendLoad();
        this.LoadPosts();
    },
    methods: {
        changeCount() {
            --this.user.FriendCount;
            this.friendLoad();
        },
        newPost(data) {
            this.user.PostCount += 1;
            this.posts.unshift(data);
            window.scrollTo({ top: 0, behavior: "smooth" });
            this.imagesLoad();
        },
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
                    this.user = res.data;

                    if (this.user.message != undefined) {
                        this.message = this.user.message;
                    } else {
                        this.message = "";
                    }
                    Echo.private(`cancelRequest.${this.user.id}`).listen(
                        "CancelRequestEvent",
                        e => {
                            if (this.user.status == "friend") {
                                this.message = "";
                            }
                        }
                    );
                    Echo.private(`acceptRequest.${this.user.id}`).listen(
                        "AcceptRequestEvent",
                        e => {
                            if (this.user.status == "friend") {
                                this.message = "friend";
                            }
                            ++this.user.FriendCount;
                            this.friendLoad();
                        }
                    );
                    Echo.private(`unfriend.${this.user.id}`).listen(
                        "UnfriendEvent",
                        e => {
                            if (this.user.status == "friend") {
                                this.message = "";
                            }
                            console.log(e);
                            --this.user.FriendCount;
                            this.friendLoad();
                        }
                    );
                });

            axios.get("/profile").then(res => {
                this.OnlineUser = res.data;
                this.loaded = true;
                Echo.private(`cancelRequest.${this.OnlineUser.id}`).listen(
                    "CancelRequestEvent",
                    e => {
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
                        this.message = "friend";
                    }
                );

                Echo.private(`unfriend.${this.OnlineUser.id}`).listen(
                    "UnfriendEvent",
                    e => {
                        if (this.user.status == "friend") {
                            this.message = "";
                        }
                        console.log(e);
                        --this.user.FriendCount;
                        this.friendLoad();
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
                    this.message = "cancel";
                });
        },
        DeleteRequest() {
            axios
                .post("/DeleteRequest", {
                    id: this.user.id
                })
                .then(res => {
                    this.message = "";
                });
        },
        AcceptRequest() {
            axios
                .post("/AcceptRequest", {
                    id: this.user.id
                })
                .then(res => {
                    this.message = "friend";
                });
        },
        RemoveFriend() {
            axios
                .post("/RemoveFriend", {
                    id: this.user.id
                })
                .then(res => {
                    this.message = "";
                    var child = this.$refs.friends;
                    child.LoadFriends();
                });
        },
        imagesLoad() {
            axios
                .post("/ProfileImages", { id: this.$route.query.user })
                .then(res => {
                    this.images = res.data;
                    console.log("this.images");
                    console.log(this.images);
                    this.introImages = [];
                    this.images.forEach(element => {
                        if (element.type == "post") {
                            this.introImages.push(element);
                        }
                    });
                    this.introImages = this.introImages.slice(0, 9);
                });
        },
        friendLoad() {
            axios
                .post("/LoadFriends", {
                    id: this.$route.query.user
                })
                .then(res => {
                    this.FriendLists = res.data;
                });
        }
    },
    watch: {
        "$route.query.user": function() {
            this.introImages = [];
            this.load();
            this.friendLoad();
            this.imagesLoad();
            this.LoadPosts();
        }
    }
};
</script>
