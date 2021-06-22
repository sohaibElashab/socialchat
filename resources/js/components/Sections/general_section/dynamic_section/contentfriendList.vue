<template>
    <div id="content-page" class="content-page">
        <div class="container" v-if="friends != null && friends.length > 0">
            <div class="row">
                <div
                    class="col-md-6"
                    v-for="friend in friends"
                    :key="friend.id"
                >
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header-image">
                                <div class="cover-container">
                                    <img
                                        :src="
                                            `images/user/${friend.coverimg.name}`
                                        "
                                        alt="profile-bg"
                                        class="rounded img-fluid w-100"
                                    />
                                </div>
                                <div class="profile-info p-4">
                                    <div class="user-detail">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-start"
                                        >
                                            <div class="profile-detail d-flex">
                                                <div class="profile-img pr-4">
                                                    <img
                                                        :src="
                                                            `images/user/${friend.profileimg.name}`
                                                        "
                                                        alt="profile-img"
                                                        class="avatar-130 img-fluid"
                                                    />
                                                </div>
                                                <div class="user-data-block">
                                                    <h4 class="">
                                                        {{ friend.name }}
                                                    </h4>
                                                    <h6>
                                                        {{ friend.interested }}
                                                    </h6>
                                                    <p>
                                                        {{ friend.about }}
                                                    </p>
                                                </div>
                                            </div>
                                            <router-link
                                                :to="{
                                                    name: 'profile',
                                                    query: {
                                                        user: friend.id
                                                    }
                                                }"
                                                tag="a"
                                                ><!--  params: {
                                                        id: friend.id
                                                    },-->
                                                <button class="btn btn-primary">
                                                    Visit profile
                                                </button>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header-image">
                                <div class="profile-info p-4">
                                    <div class="user-detail">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-start"
                                        >
                                            <h6>
                                                Start making some friends so
                                                they show up in here
                                            </h6>
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
export default {
    data() {
        return {
            friends: null,
            OnlineUser: null
        };
    },
    mounted() {
        this.LoadFriends();

        axios.get("/profile").then(res => {
            this.OnlineUser = res.data;
            Echo.private(`acceptRequest.${this.Id}`).listen(
                "AcceptRequestEvent",
                e => {
                    // document.getElementById("New").style.display = "initial";
                    this.LoadFriends();
                }
            );
        });
    },
    methods: {
        LoadFriends() {
            axios
                .post("/LoadFriends", {
                    id: null
                })
                .then(res => {
                    this.friends = res.data;
                });
            // document.getElementById("New").style.display = "none";
        }
    }
};
</script>
