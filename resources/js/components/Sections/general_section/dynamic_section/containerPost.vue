<template>
    <div class="container mt-5 pt-5">
        <Post :post="post" :singlePost="singlePost" />
    </div>
</template>

<script>
import Post from "../../single_section/Post";
export default {
    components: {
        Post
    },
    data() {
        return {
            post: null,
            singlePost: true
        };
    },
    mounted() {
        Echo.private(`sharePost.${this.$route.query.postId}`).listen(
            "SharePostEvent",
            e => {
                this.post.numbers.shares += 1;
            }
        );
        Echo.private(`likePost.${this.$route.query.postId}`).listen(
            "likePostEvent",
            e => {
                if (e.id == this.post.id) {
                    e.etat
                        ? --this.post.numbers.likes
                        : ++this.post.numbers.likes;
                }
            }
        );
        axios.post("/GetPost", { id: this.$route.query.postId }).then(res => {
            this.post = res.data;
        });
    }
};
</script>
