<template>
    <div id="content-page" class="content-page" ref="home">
        <div class="container">
            <div class="row" id="newP" style="display:none" @click="LoadNew">
                <div class="col-12 new">
                    <i class="ri-arrow-up-circle-line"></i>
                    <span>New Posts</span>
                </div>
            </div>
            <div class="row rowHome">
                <div class="col-lg-8 row m-0 p-0">
                    <div class="col-sm-12">
                        <CreatePost @newPost="newPost" />
                    </div>
                    <div class="col-sm-12" v-if="posts">
                        <Post
                            v-for="(post, index) in posts"
                            :key="index"
                            :post="post"
                        />
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
import EventBus from "../../../../event-bus";
export default {
    components: {
        story,
        CreatePost,
        Post
    },
    data() {
        return {
            posts: null,
            friends: null,
            NewPosts: []
        };
    },
    mounted() {
        axios.get("/GetPosts").then(res => {
            this.posts = res.data;
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
                this.NewPosts.unshift(e.post);
                document.getElementById("newP").style.display = "initial";
            }
        });
        EventBus.$on("image", this.addImage);
    },
    methods: {
        LoadNew() {
            this.NewPosts.forEach(element => {
                this.newPost(element);
            });
            window.scrollTo({ top: 0, behavior: "smooth" });
            document.getElementById("newP").style.display = "none";
        },
        newPost(data) {
            this.posts.unshift(data);
            window.scrollTo({ top: 0, behavior: "smooth" });
        },
        checkFriend(id) {
            var p = null;

            this.friends.forEach(friend => {
                if (friend.id == id) {
                    p = friend;
                    return true;
                }
            });
            return p;
        }
    }
};
</script>

<style scoped>
.new {
    position: fixed;
    z-index: 1;
    width: 140px;
    left: 40%;
    height: 40px;
    border-radius: 20px;
    text-align: center;
    margin-top: 10px;
    cursor: pointer;
}
.new > span {
    font-size: 15px;
    position: relative;
    top: 3px;
}
.new > i {
    font-size: 20px;
    position: relative;
    top: 2px;
}
</style>
