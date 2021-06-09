<template>
    <div class="comment-area mt-3">
        <div class="d-flex justify-content-between align-items-center">
          <div class="like-block position-relative d-flex align-items-center">
             <div class="d-flex align-items-center">
                <div class="like-data">
                   <div class="dropdown">
                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                         <i class="lar la-heart"></i>
                      </span>
                   </div>
                </div>
                <div class="total-like-block ml-2 mr-3">
                   <div class="dropdown">
                      <span aria-haspopup="true" aria-expanded="false" role="button">
                      140
                      </span>
                   </div>
                </div>
             </div>
             <div class="total-like-block ml-2 mr-3">
                <span >
                   <i class="lar la-comments"></i> 20
                </span>
             </div>
             <div class="total-like-block ml-2 mr-3">
                <a href="javascript:void();">
                   <span ><i class="las la-share"></i> 99</span>
                </a>
             </div>
          </div>
          <div class="share-block d-flex align-items-center feather-icon mr-3">
             <div>
                <span class="save" :class="{ active : saved }" @click="save()">
                   <i class="lar la-bookmark"></i>
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
            posts:null,
        }
    },
    mounted(){
        axios
            .post("/check-post", {id : this.id})
            .then(res => {
                this.saved = res.data;
            })
            .catch(err => {
                console.log(err);
            });

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
        }
    }
}
</script>

<style scoped>
.save{
    cursor: pointer;
}
.save:hover{
    color: var(--iq-primary-hover);
}
.active{
    color: var(--iq-primary-hover);
}
</style>