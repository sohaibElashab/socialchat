<template>
    <div class="container mt-5 pt-5" >
        <Post
            v-for="(post , index) in posts"
            :key="index"
            :post="post"
            @unsavePost="newPost"
        />
    </div>
</template>

<script>
import Post from "../../single_section/Post";
export default {
    components:{Post},
    data() {
        return {
            posts:null
        };
    },
    mounted() {
            this.getsave()
    },
    methods: {
        newPost(){
            this.getsave()
        },
        getsave(){
            axios.get("/posts-saved")
                .then(res => {
                    console.log("this.posts");
                    this.posts = res.data;
                    console.log(res.data);
            });
        }
    }
};
</script>
