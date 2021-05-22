<template>
    <div class="row">
        <div
            class="col-md-6 col-lg-6 mb-3"
            v-for="FriendList in FriendLists"
            :key="FriendList.id"
        >
            <div class="iq-friendlist-block">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <router-link
                            :to="{
                                name: 'profile',
                                params: { id: FriendList.id },
                                query: { user: FriendList.name }
                            }"
                            tag="a"
                        >
                            <a>
                                <img
                                    :src="
                                        `images/user/${FriendList.profileimg.name}`
                                    "
                                    alt="profile-img"
                                    style="width: 150px ; height: 150px;"
                                />
                            </a>
                        </router-link>
                        <div class="friend-info ml-3">
                            <h5>{{ FriendList.name }}</h5>
                            <p class="mb-0">
                                {{ FriendList.FriendCount }} friends
                            </p>
                        </div>
                    </div>
                    <div
                        class="iq-card-header-toolbar d-flex align-items-center"
                    >
                        <div v-if="status == 'current'">
                            <!--    <span
                                class="dropdown-toggle btn btn-danger mr-2"
                                id="dropdownMenuButton01"
                                data-toggle="dropdown"
                                aria-expanded="true"
                                role="button"
                                @click="RemoveFriend(FriendList.id)"
                            >
                                <i
                                    class="ri-check-line mr-1 text-white font-size-16"
                                ></i>
                                Unfriend
                            </span> -->
                            <button
                                class="mr-2 btn btn-danger"
                                @click="RemoveFriend(FriendList.id)"
                            >
                                <i
                                    class="ri-check-line mr-1 text-white font-size-16"
                                ></i>
                                Unfriend
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        Id: {
            type: Number,
            require: true
        },
        status: {
            type: String
        }
    },
    data() {
        return {
            FriendLists: null
        };
    },
    mounted() {
        this.LoadFriends();
    },
    methods: {
        RemoveFriend(id) {
            axios
                .post("/RemoveFriend", {
                    id: id
                })
                .then(res => {
                    console.log(res);
                    this.LoadFriends();
                });
        },
        LoadFriends() {
            axios
                .post("/LoadFriends", {
                    id: this.Id
                })
                .then(res => {
                    console.log(res.data);
                    this.FriendLists = res.data;
                });
        }
    },
    watch: {
        Id: function() {
            this.LoadFriends();
        }
    }
};
</script>
