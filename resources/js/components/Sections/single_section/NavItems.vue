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
                <a
                    href="#"
                    class="search-toggle iq-waves-effect"
                    @click="removeDotNOT"
                >
                    <i class="las la-bell"></i>
                    <span
                        class="bg-danger dots"
                        id="redNOT"
                        style="display:none;"
                    ></span>
                </a>
                <div class="iq-sub-dropdown">
                    <div class="iq-card shadow-none m-0">
                        <div
                            class="iq-card-body p-0 "
                            v-if="Allnotifs.length > 0"
                        >
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Notifications<small
                                        class="badge  badge-light float-right pt-1"
                                        >{{ Allnotifs.length }}</small
                                    >
                                </h5>
                            </div>
                            <a
                                class="iq-sub-card"
                                v-for="notification in Notifications"
                                :key="notification.id"
                            >
                                <router-link
                                    v-if="notification.type == 'request'"
                                    to="/friendRequest"
                                    tag="a"
                                >
                                    <div class="media align-items-center">
                                        <div class="">
                                            <img
                                                class="avatar-40 rounded"
                                                :src="notification.userImg"
                                                alt=""
                                            />
                                        </div>
                                        <div class="media-body ml-3">
                                            <small
                                                class="float-right font-size-12"
                                                >{{ notification.time }}</small
                                            >
                                            <p class="mb-0">
                                                {{ notification.WhatDo }}
                                            </p>
                                            <h6 class="mb-0 ">
                                                {{ notification.userName }}
                                            </h6>
                                        </div>
                                    </div>
                                </router-link>
                                <router-link
                                    v-if="notification.type != 'request'"
                                    :to="{
                                        name: 'post',
                                        query: {
                                            postId: notification.post_id
                                        }
                                    }"
                                    tag="a"
                                >
                                    <div class="media align-items-center">
                                        <div class="">
                                            <img
                                                class="avatar-40 rounded"
                                                :src="notification.userImg"
                                                alt=""
                                            />
                                        </div>
                                        <div class="media-body ml-3">
                                            <small
                                                class="float-right font-size-12"
                                                >{{ notification.time }}</small
                                            >
                                            <p class="mb-0">
                                                {{ notification.WhatDo }}
                                            </p>
                                            <h6 class="mb-0 ">
                                                {{ notification.userName }}
                                            </h6>
                                        </div>
                                    </div>
                                </router-link>
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
                        <div class="iq-card-body p-0 " v-else>
                            <div class="bg-primary p-3">
                                <h5 class="mb-0 text-white">
                                    All Notifications
                                </h5>
                            </div>
                            <div class="iq-sub-card">
                                <div class="media align-items-center">
                                    <h6>You have no Notifications</h6>
                                </div>
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
            friends: [],
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
            Allnotifs: [],
            Notifications: [],
            toastr: {
                title: "Toastr Notification",
                message: "Gnome & Growl type non-blocking notifications",
                closeButton: true,
                progressBar: false,
                icon: null,
                position: "top right",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                showDuration: 1000,
                hideDuration: 1000,
                delay: 0,
                timeOut: "4000"
            }
        };
    },
    async mounted() {
        await axios.get("/profile").then(res => {
            this.user = res.data;
            this.img = this.user.profileimg.name;
            this.isMounted = true;
            Echo.private(`sendRequest.${this.user.id}`).listen(
                "SendRequestEvent",
                e => {
                    this.allReqs.unshift(e.user);
                    this.friendReqs = this.allReqs.slice(0, 4);
                    this.loadedReqs = true;
                    sessionStorage.setItem("click_req", false);
                    document.getElementById("redREQ").style.display = "initial";
                }
            );
            Echo.private(`cancelRequest.${this.user.id}`).listen(
                "CancelRequestEvent",
                e => {
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
                        sessionStorage.setItem("click_msg", false);
                        document.getElementById("redMSG").style.display =
                            "initial";
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

            Echo.private(`Notification.${this.user.id}`).listen(
                "NotificationEvent",
                async e => {
                    await this.Allnotifs.unshift(e.notif);
                    this.Notifications = this.Allnotifs.slice(0, 4);
                    await sessionStorage.setItem("click_not", false);
                    document.getElementById("redNOT").style.display = "initial";

                    // await this.showToast(e.notif.userName, e.notif.WhatDo)
                }
            );
        });


        axios
            .post("/LoadFriends", {
                id: null
            })
            .then(res => {
                this.friends = res.data;
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
                this.Allnotifs.unshift(notif);
                this.Notifications = this.Allnotifs.slice(0, 4);
                sessionStorage.setItem("click_not", false);
                document.getElementById("redNOT").style.display = "initial";
                // this.showToast(e.post.userName, "Posted in his profile");oui
            }
        });

        axios.get("/LoadRequests").then(res => {
            this.allReqs = res.data;
            this.friendReqs = this.allReqs.slice(0, 4);
            this.loadedReqs = true;
            if (
                this.allReqs.length > 0 &&
                sessionStorage.getItem("click_req") === "false"
            ) {
                document.getElementById("redREQ").style.display = "initial";
            }
        });

        axios.get("/UnreadMessages").then(res => {
            this.msgCount = res.data[1];
            this.ALLmsg = res.data[0];
            this.messages = this.ALLmsg.slice(0, 4);
            if (
                this.msgCount > 0 &&
                sessionStorage.getItem("click_msg") === "false"
            ) {
                document.getElementById("redMSG").style.display = "initial";
            }
        });

        axios.get("/LoadNotif").then(res => {
            this.Allnotifs = res.data;
            this.Notifications = this.Allnotifs.slice(0, 4);
            if (
                this.Allnotifs.length > 0 &&
                sessionStorage.getItem("click_not") === "false"
            ) {
                document.getElementById("redNOT").style.display = "initial";
            }
        });

        EventBus.$on("user-update", this.updateUser);
        EventBus.$on("reload-uread", this.ReloadMSG);
        EventBus.$on("reload-notif", this.ReloadNOTIF);

        window.onload = function() {
            if (sessionStorage.getItem("themeMode") !== null) {
                sessionStorage.setItem("themeMode", false);
                document.getElementById("swit").checked = false;
            }
        };
        if (sessionStorage.getItem("themeMode") === null) {
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
        ReloadNOTIF(data) {
            axios.get("/LoadNotif").then(res => {
                this.Allnotifs = res.data;
                this.Notifications = this.Allnotifs.slice(0, 4);
                if (this.Allnotifs.length > 0) {
                    document.getElementById("redNOT").style.display = "initial";
                }
            });
        },
        // showToast(title, message) {
        //     this.toastr = Object.assign(this.toastr, {
        //         color: "#50b5ff",
        //         title: title,
        //         message: message
        //     });
        //     this.$toast.success(this.toastr);
        // },
        checkFriend(id) {
            var p = null;

            this.friends.forEach(friend => {
                if (friend.id == id) {
                    p = friend;
                    return true;
                }
            });
            return p;
        },
        ReloadMSG(data) {
            axios.get("/UnreadMessages").then(res => {
                this.msgCount = res.data[1];
                this.ALLmsg = res.data[0];
                this.messages = this.ALLmsg.slice(0, 4);
            });
        },
        aplaytheme() {
            var loading = document.getElementById("loading");
            var mode = (a, b, c) => {
                this.modeTOmode(a, b, c).then(() => {
                    return true;
                });
            };

            function step1() {
                loading.style.display = "block";
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
                setTimeout(() => {
                    step3();
                    var theme = swit.checked ? "dark" : "light";
                    document
                        .querySelectorAll("link[href*='" + theme + "']")
                        .forEach(elem => {
                            document.head.removeChild(elem);
                        });
                }, 1000);
            }

            function step3() {
                loading.style.display = "none";
            }

            step1();
        },
        updateUser(data) {
            this.user = data;
            if (this.user.profile) {
                this.img = this.user.profile;
            }
        },
        DeleteRequest(id) {
            axios
                .post("/DeleteReq", {
                    id: id
                })
                .then(res => {
                    axios.get("/LoadRequests").then(res => {
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
                    axios.get("/LoadRequests").then(res => {
                        this.allReqs = res.data;
                        this.friendReqs = this.allReqs.slice(0, 4);
                        this.loadedReqs = true;
                    });
                });
        },
        check() {
            var reverse =
                sessionStorage.getItem("themeMode") == "true"
                    ? "false"
                    : "true";
            sessionStorage.setItem("themeMode", reverse);
            this.aplaytheme();
        },
        async modeTOmode(href1, href2, href3) {
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
            sessionStorage.setItem("click_req", true);
        },
        removeDotMSG() {
            document.getElementById("redMSG").style.display = "none";
            sessionStorage.setItem("click_msg", true);
        },
        removeDotNOT() {
            document.getElementById("redNOT").style.display = "none";
            sessionStorage.setItem("click_not", true);
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
