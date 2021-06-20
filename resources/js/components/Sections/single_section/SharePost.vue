<template>
    <div class="SharePostWrap" id="SharePostWrap" style="display:none">
        <div class="fake" @click="close"></div>
        <div class="col-lg-4" style="z-index:12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title d-flex flex-wrap">
                        <h4 class="card-title mr-3 ml-3">
                            Share post
                        </h4>
                        <div class="iq-card-post-toolbar mr-4">
                            <span
                                class="dropdown-toggle "
                                style="position:absolute;right:0;margin-right:25px;"
                                role="button"
                                @click="close"
                            >
                                <i
                                    data-dismiss="modal"
                                    class="ri-close-fill"
                                ></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="iq-card-body">
                    <ul
                        class="media-story m-0 p-0"
                        style="list-style-type: none;"
                    >
                        <li class="d-flex mb-4 align-items-center">
                            <div class="chat-searchbar " style="width:100%">
                                <div class="form-group chat-search-data m-0">
                                    <input
                                        type="text"
                                        class="form-control round"
                                        id="chat-search"
                                        placeholder="Search friends"
                                        v-model="value"
                                        @keyup="search"
                                        @keydown.space="space"
                                    />
                                    <i class="ri-search-line"></i>
                                </div>
                            </div>
                        </li>
                        <li>
                            <ul
                                style="height:400px;overflow:scroll;list-style-type: none;"
                            >
                                <li
                                    class="d-flex mb-4 align-items-center "
                                    v-for="friend in friends"
                                    :key="friend.id"
                                    style="position:relative;"
                                >
                                    <img
                                        :src="
                                            `images/user/${friend.profileimg.name}`
                                        "
                                        alt="story-img"
                                        class="rounded-circle img-fluid"
                                    />
                                    <div class="stories-data ml-3">
                                        <h5>{{ friend.name }}</h5>
                                    </div>
                                    <div class="stories-data ml-3">
                                        <button
                                            class="btn btn-primary rounded mt-2 mr-2 sendBtn"
                                            style="position:absolute;right:0;top:0;"
                                            @click="send($event, friend.id)"
                                        >
                                            Send
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from "../../../event-bus";
export default {
    data() {
        return {
            post_id: "",
            value: "",
            friends: []
        };
    },
    mounted() {
        //this.loadFriends();
        EventBus.$on("postID", this.postID);
    },
    methods: {
        async send(e, id) {
            e.target.innerHTML = "Sending ...";

            var d = new Date();
            var time = d.getHours() + ":" + d.getMinutes();

            await axios
                .post("/NewMessage", {
                    id: id,
                    text: "http://127.0.0.1:8000/#/post?postId=" + this.post_id,
                    image: "null",
                    video: "null",
                    time: time
                })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });

            await axios
                .post("/SharePost", {
                    post_id: this.post_id
                })
                .then(res => {
                    console.log(res);
                    e.target.disabled = true;
                    e.target.innerHTML =
                        '<i class="ri-check-line mr-1 text-white font-size-16" ></i>';
                })
                .catch(err => {
                    console.log(err);
                });
        },
        postID(data) {
            this.post_id = data;
            this.loadFriends();
        },
        close() {
            document.getElementById("SharePostWrap").style.display = "none";
            document.body.style.overflowY = "scroll";
        },
        loadFriends() {
            var btns = document.getElementsByClassName("sendBtn");
            for (var i = 0; i < btns.length; i++) {
                btns[i].disabled = false;
                btns[i].innerHTML = "Send";
            }
            axios
                .post("/LoadFriends", {
                    id: null
                })
                .then(res => {
                    //console.log(res.data);
                    this.friends = res.data;
                });
        },
        search() {
            if (this.value != "") {
                axios
                    .post("/ChatSearch", {
                        value: this.value
                    })
                    .then(response => {
                        //console.log(response.data);
                        this.friends = response.data;
                    });
            } else {
                this.loadFriends();
            }
        },
        space(e) {
            if (this.value === "") {
                e.preventDefault();
            }
        }
    }
};
</script>

<style scoped>
#ser {
    position: absolute;
    width: 100%;
    background-color: var(--iq-dark-box);
    color: var(--iq-dark-title-text);
}

#pp {
    padding: 10px;
}

.fake {
    position: absolute;
    top: 0%;
    left: 0%;
    height: 100%;
    width: 100%;
    background: transparent;
    z-index: -1;
}
</style>
