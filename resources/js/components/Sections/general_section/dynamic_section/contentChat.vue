<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-body chat-page p-0">
                            <div class="chat-data-block">
                                <div class="row">
                                    <div
                                        class="col-lg-3 chat-data-left scroller"
                                    >
                                        <div
                                            class="chat-search pt-3 pl-3"
                                            v-if="CurrentUser"
                                        >
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <div class="chat-profile mr-3">
                                                    <img
                                                        :src="
                                                            `images/user/${CurrentUser.profileimg.name}`
                                                        "
                                                        alt="chat-user"
                                                        class="avatar-60 "
                                                    />
                                                </div>
                                                <div class="chat-caption">
                                                    <h5 class="mb-0">
                                                        {{ CurrentUser.name }}
                                                    </h5>
                                                    <!--  <p class="m-0">
                                                        Web Designer
                                                    </p> -->
                                                </div>
                                                <button
                                                    type="submit"
                                                    class="close-btn-res p-3"
                                                >
                                                    <i
                                                        class="ri-close-fill"
                                                    ></i>
                                                </button>
                                            </div>
                                            <div
                                                id="user-detail-popup"
                                                class="scroller"
                                            >
                                                <div class="user-profile">
                                                    <button
                                                        type="submit"
                                                        class="close-popup p-3"
                                                    >
                                                        <i
                                                            class="ri-close-fill"
                                                        ></i>
                                                    </button>
                                                    <div
                                                        class="user text-center mb-4"
                                                    >
                                                        <a class="avatar m-0">
                                                            <img
                                                                src="images/user/1.jpg"
                                                                alt="avatar"
                                                            />
                                                        </a>
                                                        <div
                                                            class="user-name mt-4"
                                                        >
                                                            <h4>Bni Jordan</h4>
                                                        </div>
                                                        <div class="user-desc">
                                                            <p>Web Designer</p>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div
                                                        class="user-detail text-left mt-4 pl-4 pr-4"
                                                    >
                                                        <h5 class="mt-4 mb-4">
                                                            About
                                                        </h5>
                                                        <p>
                                                            It is long
                                                            established fact
                                                            that a reader will
                                                            be distracted bt the
                                                            reddable.
                                                        </p>
                                                        <h5 class="mt-3 mb-3">
                                                            Status
                                                        </h5>
                                                        <ul
                                                            class="user-status p-0"
                                                        >
                                                            <li class="mb-1">
                                                                <i
                                                                    class="ri-checkbox-blank-circle-fill text-success pr-1"
                                                                ></i
                                                                ><span
                                                                    >Online</span
                                                                >
                                                            </li>
                                                            <li class="mb-1">
                                                                <i
                                                                    class="ri-checkbox-blank-circle-fill text-warning pr-1"
                                                                ></i
                                                                ><span
                                                                    >Away</span
                                                                >
                                                            </li>
                                                            <li class="mb-1">
                                                                <i
                                                                    class="ri-checkbox-blank-circle-fill text-danger pr-1"
                                                                ></i
                                                                ><span
                                                                    >Do Not
                                                                    Disturb</span
                                                                >
                                                            </li>
                                                            <li class="mb-1">
                                                                <i
                                                                    class="ri-checkbox-blank-circle-fill text-light pr-1"
                                                                ></i
                                                                ><span
                                                                    >Offline</span
                                                                >
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-searchbar mt-4">
                                                <div
                                                    class="form-group chat-search-data m-0"
                                                >
                                                    <input
                                                        type="text"
                                                        class="form-control round"
                                                        id="chat-search"
                                                        placeholder="Search friends"
                                                        v-model="value"
                                                        @keyup="search"
                                                        @keydown.space="space"
                                                    />
                                                    <i
                                                        class="ri-search-line"
                                                    ></i>
                                                    <div
                                                        id="ser"
                                                        v-if="
                                                            results.length != 0
                                                        "
                                                    >
                                                        <ul>
                                                            <li
                                                                v-for="result in results"
                                                                :key="result.id"
                                                            >
                                                                <router-link
                                                                    :to="{
                                                                        name:
                                                                            'chat',
                                                                        query: {
                                                                            user:
                                                                                result.id
                                                                        }
                                                                    }"
                                                                    v-on:click.native="
                                                                        vide()
                                                                    "
                                                                    tag="a"
                                                                    id="pp"
                                                                >
                                                                    <div
                                                                        class=""
                                                                    >
                                                                        <img
                                                                            class="avatar-40 rounded"
                                                                            :src="
                                                                                `images/user/${result.profileimg.name}`
                                                                            "
                                                                            alt="pp"
                                                                        />
                                                                    </div>
                                                                    <span>{{
                                                                        result.name
                                                                    }}</span>
                                                                </router-link>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <SliderChat
                                            :CurrentUser="CurrentUser"
                                            v-if="loaded"
                                        />
                                    </div>
                                    <div
                                        class="col-lg-9 chat-data p-0 chat-data-right"
                                    >
                                        <div class="tab-content">
                                            <Conversation
                                                :CurrentUser="CurrentUser"
                                                v-if="
                                                    $route.query.user && loaded
                                                "
                                            />
                                            <div
                                                class="tab-pane fade active show"
                                                id="default-block"
                                                role="tabpanel"
                                                v-else
                                            >
                                                <div class="chat-start">
                                                    <span
                                                        class="iq-start-icon text-primary"
                                                        ><i
                                                            class="ri-message-3-line"
                                                        ></i
                                                    ></span>
                                                    <span
                                                        class="btn bg-white mt-3"
                                                        style="cursor:default;"
                                                        >Start
                                                        Conversation!</span
                                                    >
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
import SliderChat from "../../single_section/SliderChat.vue";
import Conversation from "../../single_section/Conversation.vue";

export default {
    components: {
        SliderChat,
        Conversation
    },
    data() {
        return {
            id: "",
            CurrentUser: null,
            OtherUser: null,
            loaded: false,
            value: "",
            results: []
        };
    },
    mounted() {
        this.id = this.$route.query.user;
        axios.get("/profile").then(res => {
            this.CurrentUser = res.data;
            this.loaded = true;
        });
        this.loadOtherFriend();
    },
    methods: {
        search() {
            if (this.value === "") {
                this.results = [];
            } else {
                axios
                    .post("/ChatSearch", {
                        value: this.value
                    })
                    .then(response => {
                        this.results = response.data;
                    });
            }
        },
        loadOtherFriend() {
            if (this.$route.query.user) {
                axios
                    .post("/UserProfile", {
                        id: this.$route.query.user
                    })
                    .then(res => {
                        this.OtherUser = res.data;
                    });
            }
        },
        space(e) {
            if (this.value === "") {
                e.preventDefault();
            }
        },
        vide() {
            this.value = "";
            this.results = [];
        }
    },
    watch: {
        "$route.query.user": function() {
            this.id = this.$route.query.user;
            this.loadOtherFriend();
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
</style>
