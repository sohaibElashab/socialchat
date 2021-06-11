<template>
    <div class="collapse navbar-collapse" :class="{ show: show }">
        <ul class="navbar-nav ml-auto navbar-list">
            <li v-if="this.isMounted">
                <router-link
                    :to="{
                        name: 'profile',
                        query: { user: user.id }
                    }"
                    tag="a"
                    class="iq-waves-effect d-flex align-items-center"
                    ><!-- params: { id: user.id }, -->
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
                <a
                    class="search-toggle iq-waves-effect"
                    href="#"
                    @click="removeDot"
                    ><i class="ri-group-line"></i>
                    <span
                        class="bg-danger dots"
                        id="redREQ"
                        style="display:none;"
                    ></span>
                </a>
                <div class="iq-sub-dropdown iq-sub-dropdown-large">
                    <div class="iq-card shadow-none m-0">
                        <div
                            class="iq-card-body p-0 "
                            v-if="allReqs != null && allReqs.length > 0"
                        >
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
                                                {{ friendReq.FriendCount }}
                                                friends
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
                        <div class="iq-card-body p-0 " v-else>
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    Friend Request
                                </h5>
                            </div>
                            <div class="iq-friend-request">
                                <div
                                    class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between"
                                >
                                    <div class="d-flex align-items-center">
                                        <h6>You have no friend requests</h6>
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
                                    People you may know
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="search-toggle iq-waves-effect">
                    <i class="las la-bell"></i>
                    <span class="bg-danger dots"></span>
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
                <a
                    href="#"
                    class="search-toggle iq-waves-effect"
                    @click="removeDotMSG"
                >
                    <i class="las la-inbox"></i>
                    <span
                        class="bg-danger dots"
                        id="redMSG"
                        style="display:none;"
                    ></span>
                </a>
                <div class="iq-sub-dropdown">
                    <div class="iq-card shadow-none m-0">
                        <div
                            class="iq-card-body p-0 "
                            v-if="messages != null && messages.length > 0"
                        >
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Messages<small
                                        class="badge  badge-light float-right pt-1"
                                        >{{ msgCount }}</small
                                    >
                                </h5>
                            </div>
                            <router-link
                                v-for="message in messages"
                                :key="message.id"
                                :to="{
                                    name: 'chat',
                                    query: { user: message.id }
                                }"
                                tag="a"
                                class="iq-sub-card"
                            >
                                <div class="media align-items-center">
                                    <div class="">
                                        <img
                                            class="avatar-40 rounded"
                                            :src="message.img"
                                            alt="profile"
                                        />
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0 ">
                                            {{ message.name }}
                                        </h6>
                                        <small class="float-left font-size-12"
                                            >{{ message.count }} unread
                                            messages</small
                                        >
                                    </div>
                                </div>
                            </router-link>
                            <div class="text-center">
                                <router-link
                                    class="mr-3 btn text-primary"
                                    to="/chat"
                                    tag="a"
                                    exact=""
                                >
                                    View More Messages
                                </router-link>
                            </div>
                        </div>
                        <div class="iq-card-body p-0 " v-else>
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Messages
                                </h5>
                            </div>
                            <div class="iq-sub-card">
                                <div class="media align-items-center">
                                    <h6>You have no messages</h6>
                                </div>
                            </div>
                            <div class="text-center">
                                <router-link
                                    class="mr-3 btn text-primary"
                                    to="/chat"
                                    tag="a"
                                    exact=""
                                >
                                    Go to chat
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <span class="switcher switch">
                    <input type="checkbox" id="swit" @change="check()" />
                    <label for="swit"></label>
                    <div class="all"></div>
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
import EventBus from "../../../event-bus";
export default {
    props: {
        show: {
            type: Boolean,
            require: false
        }
    },
    data() {
        return {
            user: null,
            img: "",
            isMounted: false,
            allReqs: null,
            loadedReqs: false,
            friendReqs: null,
            isActive: false,
            ALLmsg: null,
            messages: null,
            msgCount: null,
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
                    this.friendReqs = this.allReqs.slice(0, 4);
                    this.loadedReqs = true;
                    document.getElementById("redREQ").style.display = "initial";
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
                            this.friendReqs = this.allReqs.slice(0, 4);
                            this.loadedReqs = true;
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
                            this.friendReqs = this.allReqs.slice(0, 4);
                            this.loadedReqs = true;
                        }
                    });
                }
            );

            Echo.private(`sendText.${this.user.id}`).listen(
                "SendTextEvent",
                e => {
                    if (e.message.user_id != this.$route.query.user) {
                        document.getElementById("redMSG").style.display =
                            "initial";
                        console.log(e);
                        this.msgCount += 1;
                        var p = false;
                        this.messages.forEach(m => {
                            if (m.id == e.message.user_id) {
                                m.count += 1;
                                p = true;
                            }
                        });
                        if (p == false) {
                            axios
                                .post("/UserProfile", {
                                    id: e.message.user_id
                                })
                                .then(res => {
                                    var user = res.data;
                                    var mess = {
                                        id: user.id,
                                        name: user.name,
                                        img:
                                            "images/user/" +
                                            user.profileimg.name,
                                        count: 1
                                    };
                                    this.ALLmsg.unshift(mess);
                                    this.messages = this.ALLmsg.slice(0, 4);
                                });
                        }
                    }
                }
            );
        });

        axios.get("/LoadRequests").then(res => {
            console.log(res.data);
            this.allReqs = res.data;
            this.friendReqs = this.allReqs.slice(0, 4);
            this.loadedReqs = true;
        });

        axios.get("/UnreadMessages").then(res => {
            console.log("unread");
            console.log(res.data);
            this.msgCount = res.data[1];
            this.ALLmsg = res.data[0];
            this.messages = this.ALLmsg.slice(0, 4);
            if (this.msgCount > 0) {
                document.getElementById("redMSG").style.display = "initial";
            }
        });
        EventBus.$on("user-update", this.updateUser);
        EventBus.$on("reload-uread", this.ReloadMSG);

        window.onload = function() {
            if (sessionStorage.getItem("themeMode") !== null) {
                sessionStorage.setItem("themeMode", false);
                document.getElementById("swit").checked = false;
            }
        };
        if (sessionStorage.getItem("themeMode") === null) {
            console.log("cree session");
            sessionStorage.setItem("themeMode", false);
        } else {
            if (sessionStorage.getItem("themeMode") == "true") {
                document.getElementById("swit").checked = true;
            } else {
                document.getElementById("swit").checked = false;
            }
            // check();
        }
    },
    methods: {
        ReloadMSG(data) {
            axios.get("/UnreadMessages").then(res => {
                console.log("unread");
                console.log(res.data);
                this.msgCount = res.data[1];
                this.ALLmsg = res.data[0];
                this.messages = this.ALLmsg.slice(0, 4);
            });
        },
        aplaytheme() {
            var loading = document.getElementById("loading");
            var mode = (a, b, c) => {
                this.modeTOmode(a, b, c).then(() => {
                    console.log("test");
                    return true;
                });
            };

            function step1() {
                loading.style.display = "block";
                console.log("1");
                setTimeout(() => {
                    step2();
                }, 500);
            }

            function step2() {
                if (swit.checked) {
                    mode(
                        "http://127.0.0.1:8000/css/light/typography.css",
                        "http://127.0.0.1:8000/css/light/style.css",
                        "http://127.0.0.1:8000/css/light/responsive.css"
                    );
                } else {
                    mode(
                        "http://127.0.0.1:8000/css/dark/typography.css",
                        "http://127.0.0.1:8000/css/dark/style.css",
                        "http://127.0.0.1:8000/css/dark/responsive.css"
                    );
                }
                console.log("2");
                setTimeout(() => {
                    step3();
                    var theme = swit.checked ? "dark" : "light";
                    console.log(
                        document.querySelectorAll("link[href*='" + theme + "']")
                    );
                    document
                        .querySelectorAll("link[href*='" + theme + "']")
                        .forEach(elem => {
                            document.head.removeChild(elem);
                        });
                }, 1000);
            }

            function step3() {
                loading.style.display = "none";
                console.log("3");
            }

            step1();
        },
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
            console.log("before ", sessionStorage.getItem("themeMode"));

            var reverse =
                sessionStorage.getItem("themeMode") == "true"
                    ? "false"
                    : "true";
            sessionStorage.setItem("themeMode", reverse);
            console.log("after ", sessionStorage.getItem("themeMode"));
            this.aplaytheme();
        },
        async modeTOmode(href1, href2, href3) {
            console.log("mode");

            var newlinktypography = document.createElement("link");
            var newlinkstyle = document.createElement("link");
            var newlinkresponsive = document.createElement("link");

            assignAttr(newlinkresponsive, href3);
            assignAttr(newlinktypography, href1);
            assignAttr(newlinkstyle, href2);

            newlinktypography.onload = addEventListener(
                "load",
                appendToHead(newlinktypography),
                true
            );
            newlinkstyle.onload = addEventListener(
                "load",
                appendToHead(newlinkstyle),
                true
            );
            newlinkresponsive.onload = addEventListener(
                "load",
                appendToHead(newlinkresponsive),
                true
            );

            function appendToHead(n) {
                document.head.appendChild(n);
            }

            function assignAttr(elem, href) {
                elem.setAttribute("rel", "stylesheet");
                elem.setAttribute("type", "text/css");
                elem.setAttribute("href", href);
            }
        },
        removeDot() {
            document.getElementById("redREQ").style.display = "none";
        },
        removeDotMSG() {
            document.getElementById("redMSG").style.display = "none";
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
    font-family: "Oswald", sans-serif;
}
span.switcher input:before,
span.switcher input:after {
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
}
span.switcher label span.switcher.switch input:not(:checked):before {
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
