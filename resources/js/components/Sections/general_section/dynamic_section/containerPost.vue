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
            post: {
                id: 1,
                userImg: "images/user/01.jpg",
                userName: "Anna Sthesia",
                statu: "Add New Post",
                time: "Just Now",
                text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                postImgs: [
                    { img: "images/page-img/p1.jpg" },
                    { img: "images/page-img/p2.jpg" },
                    { img: "images/page-img/p3.jpg" }
                ],
                postVds: []
            }
        };
    }
};
</script>
