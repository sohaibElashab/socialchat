<template>
    <div class="comment-area mt-3">
        <div class="d-flex justify-content-between align-items-center">
          <div class="like-block position-relative d-flex align-items-center">
             <div class="total-like-block ml-2 mr-3">
                <span role="button" :class="{ save : liked }" @click="isLike()" >
                    <i class="ri-heart-line" id="Ilike"></i>
                    <!-- <i class="ri-heart-fill"></i> -->
                     {{like}}
                </span>
             </div>
             <div class="total-like-block ml-2 mr-3">
                <span >
                   <i class="lar la-comments"></i> {{comment}}
                </span>
             </div>
             <div class="total-like-block ml-2 mr-3">
                   <span ><i class="las la-share"></i> {{share}}</span>
             </div>
          </div>
          <div class="share-block d-flex align-items-center feather-icon mr-3">
             <div>
                <span class="desactive" :class="{ save : saved }" @click="save()" >
                   <i class="ri-bookmark-line" id="Ishare"></i>
                   <!-- <i class="ri-bookmark-fill"></i> -->
                   <span class="ml-1">save</span>
                </span>
             </div>
          </div>
        </div>
        <hr>
        <ul class="post-comments p-0 m-0">
            <li class="mb-2" v-for="comment in comments" :key="comment.id"> 
                <div class="d-flex flex-wrap">
                    <div class="user-img">
                        <img :src="comment.userImg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                    </div>
                    <div class="comment-data-block ml-3">
                        <h6>{{comment.userName}}</h6>
                        <p class="mb-0">{{comment.text}}</p>
                        <div class="d-flex flex-wrap align-items-center comment-activity">
                            <a href="javascript:void();">like</a>
                            <a href="javascript:void();">reply</a>
                            <span> {{comment.time}} </span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
            <input type="text" class="form-control rounded" placeholder="Write a comment…">
            <div class="comment-attagement d-flex">
                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props:{
        id:{
            require:true,
        }
    },
    data() {
        return {
            comments: {
                "1": {
                    id: 1,
                    userImg:"images/user/01.jpg",
                    userName:"Anna Sthesia",
                    text:"Lorem ipsum dolor sit amet",
                    time:"Just Now",
                },
                "2": {
                    id: 2,
                    userImg:"images/user/03.jpg",
                    userName:"Barb Ackue",
                    statu:"Lorem ipsum dolor sit amet",
                    time:"1 hour ago",
                },
            },
            saved:Boolean,
            liked:Boolean,
            posts:null,
            like:null,
            comment:null,
            share:null,
        }
    },
    mounted(){
        axios
            .post("/check-post", {id : this.id})
            .then(res => {
                console.log("get check");
                console.log(res.data);
                this.saved = res.data.save;
                this.liked = res.data.like;
            })
            .catch(err => {
                console.log(err);
            });
        axios
            .post("/get-numbers", {id : this.id})
            .then(res => {
                this.like = res.data.likes;
                this.comment = res.data.comments;
                this.share = res.data.shares;
            })
            .catch(err => {
                console.log(err);
            });
        this.changeclass(this.liked , null , this.saved);
    },
    methods:{
        save(){
            console.log(this.id);
            if(this.saved){
                
                axios
                    .post("/unsave-post", {id : this.id})
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
                    this.$emit('unsave', true);
            }else{
                axios
                    .post("/save-post", {id : this.id})
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
            if(this.$route.name != "Saved"){
                this.saved = !this.saved;
            }
            this.changeclass(null , null ,this.saved);
        },
        isLike(){
            if(this.liked){
                axios
                    .post("/unlike-post", {id : this.id})
                    .then(res => {
                        console.log(res.data);
                        this.like = res.data.likes;
                        this.comment = res.data.comments;
                        this.share = res.data.shares;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }else{
                axios
                    .post("/like-post", {id : this.id})
                    .then(res => {
                        console.log(res.data);
                        this.like = res.data.likes;
                        this.comment = res.data.comments;
                        this.share = res.data.shares;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
            this.liked = !this.liked;
            this.changeclass(this.liked , null , null);
        },
        changeclass(l , c , s){
            if(l != null){
                if(l){
                    this.addremove('Ilike' , "ri-heart-line" , "ri-heart-fill");
                }else{
                    this.addremove('Ilike', "ri-heart-fill" , "ri-heart-line" );
                    
                }
            }
            if(s != null){
                if(s){
                    this.addremove('Ishare' , "ri-bookmark-line" , "ri-bookmark-fill");
                }else{
                    this.addremove('Ishare' , "ri-bookmark-fill" , "ri-bookmark-line" );
                }
            }
        },
        addremove(id , r , a){
            document.getElementById(id).classList.remove(r);
            document.getElementById(id).classList.add(a);
        }
    }
}
</script>

<style scoped>
.desactive{
    cursor: pointer;
}
.desactive:hover{
    color: var(--iq-primary-hover);
}
.save{
    color: var(--iq-primary-hover);
}
</style>