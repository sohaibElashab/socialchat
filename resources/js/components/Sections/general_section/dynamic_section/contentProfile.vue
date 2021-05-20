<template>
    <div id="content-page" class="content-page">
        <div class="container" v-if="user">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header">
                                <div class="cover-container">
                                    <img
                                        :src="
                                            `images/user/${user.coverimg.name}`
                                        "
                                        alt="profile-bg"
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
                                            <!--  <div v-if="user.status == 'friend'"> -->
                                            <li
                                                class="text-center pl-3"
                                                v-if="message == 'cancel'"
                                            >
                                                <button
                                                    class="mr-3 btn btn-danger rounded"
                                                    @click="DeleteRequest"
                                                >
                                                    <i
                                                        class="ri-check-line mr-1 text-white font-size-16"
                                                    ></i>
                                                    Cancel request
                                                </button>
                                            </li>
                                            <li
                                                class="text-center pl-3"
                                                v-else-if="message == 'accept'"
                                            >
                                                <button
                                                    class="mr-3 btn btn-primary rounded"
                                                    @click="AcceptRequest"
                                                >
                                                    <i
                                                        class="ri-check-line mr-1 text-white font-size-16"
                                                    ></i>
                                                    Accept request
                                                </button>
                                            </li>
                                            <li
                                                class="text-center pl-3"
                                                v-else-if="message == ''"
                                            >
                                                <button
                                                    class="mr-3 btn btn-primary rounded"
                                                    @click="sendRequest"
                                                >
                                                    <i
                                                        class="ri-user-add-line"
                                                    ></i
                                                    >Add Friend
                                                    {{ message }}
                                                </button>
                                            </li>
                                            <!--  </div> -->
                                        </ul>
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
                                                        v-for="ProfileImage in ProfileImages"
                                                        :key="ProfileImage.id"
                                                    >
                                                        <a
                                                            href="javascript:void();"
                                                        >
                                                            <img
                                                                :src="
                                                                    ProfileImage.PrfImg
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
                                                        v-for="FriendList in FriendLists"
                                                        :key="FriendList.id"
                                                    >
                                                        <a
                                                            href="javascript:void();"
                                                        >
                                                            <img
                                                                :src="
                                                                    FriendList.FrdImg
                                                                "
                                                                alt="gallary-image"
                                                                class="img-fluid"
                                                        /></a>
                                                        <h6
                                                            class="mt-2 text-center"
                                                        >
                                                            {{
                                                                FriendList.FrdName
                                                            }}
                                                        </h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <CreatePost />
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
                        <div class="tab-pane fade" id="about" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul
                                                class="nav nav-pills basic-info-items list-inline d-block p-0 m-0"
                                            >
                                                <li>
                                                    <a
                                                        class="nav-link active"
                                                        data-toggle="pill"
                                                        href="#basicinfo"
                                                        >Contact Information</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="pill"
                                                        href="#family"
                                                        >Websites and Social
                                                        Links</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="pill"
                                                        href="#work"
                                                        >Basic Information</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="pill"
                                                        href="#lived"
                                                    >
                                                        About You</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="pill"
                                                        href="#details"
                                                        >Favorite Quotes</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9 pl-4">
                                            <div class="tab-content">
                                                <div
                                                    class="tab-pane fade active show"
                                                    id="basicinfo"
                                                    role="tabpanel"
                                                >
                                                    <h4>Contact Information</h4>
                                                    <hr />
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <h6>Email</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{ user.email }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>Mobile</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.mobile
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>Address</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.adress
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    id="family"
                                                    role="tabpanel"
                                                >
                                                    <h4 class="mt-3">
                                                        Websites and Social
                                                        Links
                                                    </h4>
                                                    <hr />
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <h6>Website</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.website
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>Social Link</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.facebook
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    id="work"
                                                    role="tabpanel"
                                                >
                                                    <h4 class="mt-3">
                                                        Basic Information
                                                    </h4>
                                                    <hr />
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <h6>Birth Date</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
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
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>Birth Year</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    new Date(
                                                                        user.birth_date
                                                                    ).getFullYear()
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>Gender</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.gender
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>
                                                                interested in
                                                            </h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.interested
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div class="col-3">
                                                            <h6>language</h6>
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0">
                                                                {{
                                                                    user.language
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    id="lived"
                                                    role="tabpanel"
                                                >
                                                    <h4 class="mb-3">
                                                        About You
                                                    </h4>
                                                    <p>
                                                        {{ user.about }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    id="details"
                                                    role="tabpanel"
                                                >
                                                    <h4 class="mt-3 mb-3">
                                                        Favorite Quotes
                                                    </h4>
                                                    <p>
                                                        {{ user.quote }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- friend lists -->
                        <div class="tab-pane fade" id="friends" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <h2>Friends</h2>
                                    <div class="friend-list-tab mt-2">
                                        <div class="tab-content">
                                            <div
                                                class="tab-pane fade active show"
                                                id="all-friends"
                                                role="tabpanel"
                                            >
                                                <div class="iq-card-body p-0">
                                                    <ProfileFriend
                                                        :FriendLists="
                                                            FriendLists
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- photo galery -->
                        <div class="tab-pane fade" id="photos" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <h2>Photos</h2>
                                    <div class="friend-list-tab mt-2">
                                        <div class="tab-content">
                                            <div
                                                class="tab-pane fade active show"
                                                id="photosofyou"
                                                role="tabpanel"
                                            >
                                                <div class="iq-card-body p-0">
                                                    <ProfileImages
                                                        :ProfileImages="
                                                            ProfileImages
                                                        "
                                                    />
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
import ProfileFriend from "../../single_section/ProfileFriend";
import ProfileImages from "../../single_section/ProfileImages";
import CreatePost from "../../single_section/CreatePost";
import Post from "../../single_section/Post";
export default {
    components: {
        ProfileFriend,
        ProfileImages,
        CreatePost,
        Post
    },
    props: ["UserId"],
    data() {
        return {
            date: null,
            user: null,
            message: "",
            FriendLists: {
                "1": {
                    id: 1,
                    FrdImg: "images/user/05.jpg",
                    FrdName: "Petey Cruiser",
                    FrdNamber: "15"
                },
                "2": {
                    id: 2,
                    FrdImg: "images/user/07.jpg",
                    FrdName: "Paul Molive",
                    FrdNamber: "50"
                },
                "3": {
                    id: 3,
                    FrdImg: "images/user/06.jpg",
                    FrdName: "Anna Sthesia",
                    FrdNamber: "10"
                },
                "4": {
                    id: 4,
                    FrdImg: "images/user/08.jpg",
                    FrdName: "Gail Forcewind",
                    FrdNamber: "22"
                },
                "5": {
                    id: 5,
                    FrdImg: "images/user/09.jpg",
                    FrdName: "Paige Turner",
                    FrdNamber: "12"
                }
            },
            ProfileImages: {
                "1": {
                    id: 1,
                    PrfImg: "images/page-img/51.jpg",
                    likeNbr: "60",
                    CommentNbr: "30",
                    ShareNbr: "10"
                },
                "2": {
                    id: 2,
                    PrfImg: "images/page-img/52.jpg",
                    likeNbr: "60",
                    CommentNbr: "60",
                    ShareNbr: "60"
                },
                "3": {
                    id: 3,
                    PrfImg: "images/page-img/53.jpg",
                    likeNbr: "60",
                    CommentNbr: "60",
                    ShareNbr: "60"
                },
                "4": {
                    id: 4,
                    PrfImg: "images/page-img/54.jpg",
                    likeNbr: "60",
                    CommentNbr: "60",
                    ShareNbr: "60"
                },
                "5": {
                    id: 5,
                    PrfImg: "images/page-img/55.jpg",
                    likeNbr: "60",
                    CommentNbr: "60",
                    ShareNbr: "60"
                }
            },
            posts: {
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
        if (this.UserId != null) {
            sessionStorage.clear();
            sessionStorage.setItem("id", this.UserId);
        }
        this.load();
    },
    methods: {
        load() {
            var id = sessionStorage.getItem("id");
            console.log("profile content");
            console.log(sessionStorage.getItem("id"));
            axios
                .post("/UserProfile", {
                    id: id
                })
                .then(res => {
                    console.log(res.data);
                    this.user = res.data;
                    if (this.user.message != undefined) {
                        this.message = this.user.message;
                    } else {
                        this.message = "";
                    }
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
                });
        }
    },
    watch: {
        UserId: function() {
            if (this.UserId != null) {
                sessionStorage.clear();
                sessionStorage.setItem("id", this.UserId);
                // console.log("profile content watch");
                this.load();
            }
            console.log("z");
        }
    }
};
</script>
