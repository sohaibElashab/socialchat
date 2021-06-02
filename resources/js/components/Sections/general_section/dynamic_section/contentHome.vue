<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row rowHome">
                <div class="col-lg-8 row m-0 p-0">
                    <div class="col-sm-12">
                        <CreatePost />
                    </div>
                    <div class="col-sm-12">
                        <!-- <Post
                            v-for="(post , index) in posts"
                            :key="index"
                            :post="post"
                        /> -->

                    </div>
                    <div class="col-sm-12 text-center">
                        <img
                            src="images/page-img/page-load-loader.gif"
                            alt="loader"
                            style="height: 100px;"
                        />
                    </div>
                </div>
                <div class="col-lg-4">
                    <story />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import story from "../../single_section/Story";
import CreatePost from "../../single_section/CreatePost";
import Post from "../../single_section/Post";
export default {
    components: {
        story,
        CreatePost,
        Post
    },
    data() {
        return {
            posts: null
        };
    },
    mounted() {
        axios.get("/GetPosts")
            .then(res => {
                console.log("this.posts");
                this.posts = res.data;
                console.log(res.data);
                console.log(this.posts);
        });
    },
};
</script>
