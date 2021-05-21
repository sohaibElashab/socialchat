<template>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-list">
            <li v-if="this.isMounted">
                <router-link
                    :to="{
                        name: 'profile',
                        params: { id: user.id },
                        query: { user: user.name }
                    }"
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
                        <div class="iq-card-body p-0 " v-if="loadedReqs">
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    Friend Request<small
                                        class="badge  badge-light float-right pt-1"
                                        >{{ allReqs.length }}</small
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
                                                :src="
                                                    `images/user/${friendReq.profileimg.name}`
                                                "
                                                alt=""
                                            />
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">
                                                {{ friendReq.name }}
                                            </h6>
                                            <p class="mb-0">
                                                40 friends
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button
                                            @click="AcceptRequest(friendReq.id)"
                                            class="mr-3 btn btn-primary rounded"
                                        >
                                            Confirm
                                        </button>
                                        <button
                                            @click="DeleteRequest(friendReq.id)"
                                            class="mr-3 btn btn-secondary rounded"
                                        >
                                            Delete Request
                                        </button>
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
            <li>
                <span class="switcher switch">
                    <input type="checkbox" id="swit" @change="check()" >
                    <label for="swit" ></label>
                    <div class="all"></div>
                </span>
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
            isMounted: false,
            allReqs: null,
            loadedReqs: false,
            friendReqs: null,
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
            console.log(res.data);
            this.user = res.data;
            this.img = this.user.profileimg.name;
            this.isMounted = true;
        });

        axios.get("/LoadRequests").then(res => {
            console.log(res.data);
            this.allReqs = res.data;
            this.friendReqs = this.allReqs.slice(0, 4);
            this.loadedReqs = true;
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
        },
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
                        this.friendReqs = this.allReqs.slice(0, 4);
                        this.loadedReqs = true;
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
                        this.friendReqs = this.allReqs.slice(0, 4);
                        this.loadedReqs = true;
                    });
                });
        },
        check() {
            var loading = document.getElementById("loading")

            if(swit.checked){
                //console.log(document.getElementsByTagName("link").length);
                loading.style.display = "block"
                console.log("block")
                setTimeout(this.modeTOmode("http://127.0.0.1:8000/css/light/typography.css","http://127.0.0.1:8000/css/light/style.css","http://127.0.0.1:8000/css/light/responsive.css"), 3000);
                setTimeout(function(){ loading.style.display = "none" }, 1000);
            }else{
                loading.style.display = "block"
                console.log("block")
                setTimeout(this.modeTOmode("http://127.0.0.1:8000/css/typography.css","http://127.0.0.1:8000/css/style.css","http://127.0.0.1:8000/css/responsive.css"), 3000);
                setTimeout(function(){ loading.style.display = "none" }, 1000);
            }
        },
        modeTOmode(href1,href2,href3){
                console.log("mode")

                var oldlinktypography = document.getElementsByTagName("link").item(2);
                var oldlinkstyle = document.getElementsByTagName("link").item(3);
                var oldlinkresponsive = document.getElementsByTagName("link").item(4);

                var newlinktypography = document.createElement("link");
                var newlinkstyle = document.createElement("link");
                var newlinkresponsive = document.createElement("link");

                newlinktypography.setAttribute("rel", "stylesheet");
                newlinktypography.setAttribute("type", "text/css");
                newlinktypography.setAttribute("href", href1);

                newlinkstyle.setAttribute("rel", "stylesheet");
                newlinkstyle.setAttribute("type", "text/css");
                newlinkstyle.setAttribute("href", href2);

                newlinkresponsive.setAttribute("rel", "stylesheet");
                newlinkresponsive.setAttribute("type", "text/css");
                newlinkresponsive.setAttribute("href", href3);

                document.getElementsByTagName("head").item(0).replaceChild(newlinktypography , oldlinktypography);
                document.getElementsByTagName("head").item(0).replaceChild(newlinkstyle , oldlinkstyle);
                document.getElementsByTagName("head").item(0).replaceChild(newlinkresponsive , oldlinkresponsive);

        }
    }

};
</script>

<style scoped>
 span.switcher {
    position: relative;
    top: 8px;
    left: 8px;
    border-radius: 25px;
    margin: 20px 0;
}
 span.switcher input {
    appearance: none;
    position: relative;
    width: 50px;
    height: 25px;
    border-radius: 25px;
    background-color: #181f38;
    outline: none;
    font-family: 'Oswald', sans-serif;
}
 span.switcher input:before,  span.switcher input:after {
    z-index: 2;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #50b5ff;
}
 span.switcher label {
    height: 15px;
    width: 15px;
    z-index: 1;
    position: relative;
    top: 3px;
    border-radius: 20px;
}
 span.switcher.switch input {
    transition: 0.25s -0.1s;
}
 span.switcher.switch input:checked {
    background-color: #50b5ff;
}
 span.switcher.switch input:checked:before {
    color: #50b5ff;
    transition: color 0.5s 0.2s;
}
 span.switcher.switch input:checked:after {
    color: #ccc;
    transition: color 0.5s;
}
 span.switcher.switch input:checked + label {
    right: 50px;
    background: #ffffff;
    transition: left 0.5s, right 0.4s 0.2s;
}
 span.switcher.switch input:not(:checked) {
    background: #181f38;
    transition: background 0.5s -0.1s;
} span.switcher label
 span.switcher.switch input:not(:checked):before {
    color: #ccc;
    transition: color 0.5s;
}
 span.switcher.switch input:not(:checked):after {
    color: #181f38;
    transition: color 0.5s 0.2s;
}
 span.switcher.switch input:not(:checked) + label {
    right: 25px;
    background: #50b5ff;
    transition: left 0.4s 0.2s, right 0.5s, background 0.35s -0.1s;
}
@keyframes turn-on {
    0% {
        left: 100%;
   }
    100% {
        left: 0%;
   }
}
@keyframes turn-off {
    0% {
        right: 100%;
   }
    100% {
        right: 0%;
   }
}
</style>
