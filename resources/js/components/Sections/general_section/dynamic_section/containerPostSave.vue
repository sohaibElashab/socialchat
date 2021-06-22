<template>
    <div class="container mt-5 pt-5" v-if="posts != null && posts.length > 0">
        <Post
            v-for="(post, index) in posts"
            :key="index"
            :post="post"
            @unsavePost="newPost"
        />
    </div>
    <div class="content-page" v-else>
        <div class="container ">
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
                                                You have no saved posts
                                            </h6>
                                            <router-link
                                                to="/"
                                                tag="h6"
                                                style="cursor: pointer;"
                                                >Back to home</router-link
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
</template>

<script>
import Post from "../../single_section/Post";
export default {
    components: { Post },
    data() {
        return {
            posts: null
        };
    },
    mounted() {
        this.getsave();
    },
    methods: {
        newPost() {
            this.getsave();
        },
        getsave() {
            axios.get("/posts-saved").then(res => {
                this.posts = res.data;
            });
        }
    }
};
</script>
