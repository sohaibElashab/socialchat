<template>
    <div class="container mt-5 pt-5">
        <Post
            :post="post"
        />
    </div>
</template>

<script>
import Post from "../../single_section/Post";
export default {
    components:{
        Post
    },    
    data() {
        return {
            post: null
        };
    }, 
    mounted() {
        axios.post("/GetPost" , { id: this.$route.query.postId })
            .then(res => {
                console.log("this.post");
                this.post = res.data;
                console.log(res.data);
        });
    },
};
</script>
