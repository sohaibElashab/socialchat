<template>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-list">
            <li v-if="this.user">
                <router-link
                    to="/profile"
                    tag="a"
                    class="iq-waves-effect d-flex align-items-center"
                >
                    <img
                        :src="`images/user/${img}`"
                        class="img-fluid rounded-circle mr-3"
                        alt="user"
                    />
                    <div class="caption">
                        <h6 class="mb-0 line-height">
                            {{ this.user.name }}
                        </h6>
                    </div>
                </router-link>
            </li>
            <li>
                <router-link
                    to="/"
                    tag="a"
                    class="iq-waves-effect d-flex align-items-center"
                >
                    <i class="ri-home-line"></i>
                </router-link>
            </li>
            <li class="nav-item">
                <a class="search-toggle iq-waves-effect" href="#"
                    ><i class="ri-group-line"></i
                ></a>
                <div class="iq-sub-dropdown iq-sub-dropdown-large">
                    <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    Friend Request<small
                                        class="badge  badge-light float-right pt-1"
                                        >4</small
                                    >
                                </h5>
                            </div>
                            <div
                                class="iq-friend-request"
                                v-for="friendReq in friendReqs"
                                :key="friendReq.id"
                            >
                                <div
                                    class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between"
                                >
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img
                                                class="avatar-40 rounded"
                                                :src="friendReq.img"
                                                alt=""
                                            />
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">
                                                {{ friendReq.H6 }}
                                            </h6>
                                            <p class="mb-0">
                                                {{ friendReq.p }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-primary rounded"
                                            >Confirm</a
                                        >
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-secondary rounded"
                                            >Delete Request</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <router-link
                                    class="mr-3 btn text-primary"
                                    to="/friendRequest"
                                    tag="a"
                                    exact=""
                                >
                                    View More Request
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="search-toggle iq-waves-effect">
                    <i class="las la-bell"></i>
                </a>
                <div class="iq-sub-dropdown">
                    <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Notifications<small
                                        class="badge  badge-light float-right pt-1"
                                        >4</small
                                    >
                                </h5>
                            </div>
                            <a
                                href="#"
                                class="iq-sub-card"
                                v-for="notification in Notifications"
                                :key="notification.id"
                            >
                                <div class="media align-items-center">
                                    <div class="">
                                        <img
                                            class="avatar-40 rounded"
                                            :src="notification.img"
                                            alt=""
                                        />
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 ">
                                            {{ notification.H6 }}
                                        </h6>
                                        <small
                                            class="float-right font-size-12"
                                            >{{ notification.small }}</small
                                        >
                                        <p class="mb-0">{{ notification.p }}</p>
                                    </div>
                                </div>
                            </a>
                            <div class="text-center">
                                <router-link
                                    class="mr-3 btn text-primary"
                                    to="/notification"
                                    tag="a"
                                    exact=""
                                >
                                    View More Notification
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="search-toggle iq-waves-effect">
                    <i class="las la-inbox"></i>
                </a>
                <div class="iq-sub-dropdown">
                    <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Messages<small
                                        class="badge  badge-light float-right pt-1"
                                        >5</small
                                    >
                                </h5>
                            </div>
                            <a
                                href="#"
                                class="iq-sub-card"
                                v-for="message in messages"
                                :key="message.id"
                            >
                                <div class="media align-items-center">
                                    <div class="">
                                        <img
                                            class="avatar-40 rounded"
                                            :src="message.img"
                                            alt=""
                                        />
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 ">{{ message.H6 }}</h6>
                                        <small
                                            class="float-left font-size-12"
                                            >{{ message.small }}</small
                                        >
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import EventBus from "../../../event-bus";
export default {
    data() {
        return {
            user: null,
            img: "",
            friendReqs: {
                "1": {
                    id: 1,
                    img: "images/user/01.jpg",
                    H6: "Jaques Amole",
                    p: "40  friends"
                },
                "2": {
                    id: 2,
                    img: "images/user/02.jpg",
                    H6: "Lucy Tania",
                    p: "12  friends"
                },
                "3": {
                    id: 3,
                    img: "images/user/03.jpg",
                    H6: "Manny Petty",
                    p: "3  friends"
                },
                "4": {
                    id: 4,
                    img: "images/user/04.jpg",
                    H6: "Marsha Mello",
                    p: "15  friends"
                }
            },
            Notifications: {
                "1": {
                    id: 1,
                    img: "images/user/01.jpg",
                    H6: "Emma Watson Bni",
                    small: "Just Now",
                    p: "95 MB"
                },
                "2": {
                    id: 2,
                    img: "images/user/02.jpg",
                    H6: "New customer is join",
                    small: "5 days ago",
                    p: "Cyst Bni"
                },
                "3": {
                    id: 3,
                    img: "images/user/03.jpg",
                    H6: "Two customer is left",
                    small: "2 days ago",
                    p: "Cyst Bni"
                },
                "4": {
                    id: 4,
                    img: "images/user/04.jpg",
                    H6: "New Mail from Fenny",
                    small: "3 days ago",
                    p: "Cyst Bni"
                }
            },
            messages: {
                "1": {
                    id: 1,
                    img: "images/user/01.jpg",
                    H6: "Emma Watson Bni",
                    small: "Just Now"
                },
                "2": {
                    id: 2,
                    img: "images/user/02.jpg",
                    H6: "New customer is join",
                    small: "5 days ago"
                },
                "3": {
                    id: 3,
                    img: "images/user/03.jpg",
                    H6: "Two customer is left",
                    small: "2 days ago"
                },
                "4": {
                    id: 4,
                    img: "images/user/04.jpg",
                    H6: "New Mail from Fenny",
                    small: "3 days ago"
                }
            }
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            //console.log(res.data);
            this.user = res.data;
            this.img = this.user.profileimg.name;
        });
        EventBus.$on("user-update", this.updateUser);
    },
    methods: {
        updateUser(data) {
            this.user = data;
            if (this.user.profile) {
                this.img = this.user.profile;
                console.log(this.user);
            }
        }
    }
};
</script>
