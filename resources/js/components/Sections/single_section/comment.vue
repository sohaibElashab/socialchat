<template>
    <div>
        <ul class="post-comments p-0 m-0">
            <li class="mb-2" v-for="(comment , index) in comments" :key="comment.id">
                <div class="d-flex flex-wrap">
                    <div class="user-img">
                        <img
                            :src="`images/user/${comment.userImg.name}`"
                            alt="userimg"
                            class="avatar-35 rounded-circle img-fluid"
                        />
                    </div>
                    <div class="comment-data-block ml-3">
                        <h6>{{ comment.userName }}</h6>
                        <p class="mb-0">{{ comment.text }}</p>
                        <div class="d-flex flex-wrap align-items-center comment-activity">
                            <span @click="CmtLike(index)" class="d-flex" :class="{hover: comment.commentLike}"> 
                                <i class=" desactive mr-1" :class="{ 'ri-heart-line': !comment.commentLike , 'ri-heart-fill': comment.commentLike   }" ></i>
                                <span v-if="comment.likes>0">
                                    {{comment.likes}}
                                </span> 
                            </span>
                            <div v-if="comment.edit">
                                <i class="ri-delete-bin-6-line desactive ml-2 mr-2 " @click="deleteComment(index)"></i>
                            </div>
                            <span class="ml-2"> {{ comment.time }} </span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <form
            class="comment-text d-flex align-items-center mt-3"
            action="javascript:void(0);"
        >
            <div class="wrapper-emoji">
                <textarea
                    class="regular-input"
                    placeholder="Write a comment..."
                    v-model="myText"
                ></textarea>

                <emoji-picker @emoji="append" :search="search" class="iconemoji">
                    <div
                        class="emoji-invoker"
                        slot="emoji-invoker"
                        slot-scope="{ events: { click: clickEvent } }"
                        @click.stop="clickEvent"
                    >
                        <i class="ri-user-smile-line"></i>
                    </div>
                    <div slot="emoji-picker" slot-scope="{ emojis, insert }">
                        <div class="emoji-picker">
                            <div>
                                <div
                                    v-for="(emojiGroup, category) in emojis"
                                    :key="category"
                                >
                                    <h5 style="color:white">{{ category }}</h5>
                                    <div class="emojis">
                                        <span
                                            v-for="(emoji,
                                            emojiName) in emojiGroup"
                                            :key="emojiName"
                                            @click="insert(emoji)"
                                            :title="emojiName"
                                            >{{ emoji }}</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </emoji-picker>
                <!-- <input type="file" name="" id="fileComment" @change="showFile" accept="image/*" style="display:none"> -->
                <div class="comment-attagement d-flex" @click="addComment">
                    <label style=" cursor: pointer; " ><i class="ri-send-plane-2-line mr-3"></i></label>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import EmojiPicker from "vue-emoji-picker";
export default {
    components: {
        EmojiPicker
    },
    props:{
        id: {
            require:true
        }
    },
    data() {
        return {
            comments: [],
            file: null,
            fileUrl : null,
            search: "",
            myText: "",
            user: -1
        };
    },
    methods: {
        append(emoji) {
            this.myText += emoji;
        },
        addComment(){
            if(this.myText != ""){
                axios
                    .post("/add-comment", {id: this.id , text : this.myText} )
                    .then(res => {
                        console.log(res.data);
                        this.myText = '';
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        CmtLike(i) {
            axios
                .post("/like-comment", { id: this.comments[i].id , etat : this.comments[i].commentLike , postId : this.id})
                .then(res => {
                    this.comments[i].likes = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
            this.comments[i].commentLike = !this.comments[i].commentLike;
        },
        deleteComment(i){
            axios
                .post("/delete-comment", { id: this.comments[i].id })
                .then(res => {
                    console.log("delete")
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    mounted(){
        axios.get("/profile").then(res => {
            console.log(res.data);
            this.user = res.data.id;
        });

        axios
            .post("/get-comments", {id: this.id } )
            .then(res => {
                console.log(res.data);
                this.comments = res.data;
            })
            .catch(err => {
                console.log(err);
            });
        
        Echo.private(`likeComment.${this.id}`).listen(
            'LikeCommentEvent',
            e => {
                this.comments.forEach(element => {
                    if(e.id == element.id){
                        e.etat ? --element.likes : ++element.likes ; 
                    }
                });
            }
        )
        Echo.private(`Comment.${this.id}`).listen(
            'CommentEvent',
            e => {
                if(e.etat){
                    if(e.comment.userId == this.user){ 
                        e.comment.edit = true
                    }
                    this.comments.push(e.comment);
                    this.$emit('changeNumbers' , true);
                }else{
                    this.comments.forEach((element , i) => {
                        if(e.comment.id == element.id){
                            this.comments.splice(i , 1);
                            this.$emit('changeNumbers' , false);
                        }
                    });
                }
            }
        )
    },
    directives: {
        focus: {
            inserted(el) {
                el.focus();
            }
        }
    },
};
</script>

<style scoped>
.wrapper-emoji {
    width: 100%;
    justify-content: flex-start;
}
.regular-input {  
    height: 50px;
    padding: 0rem 1rem;
}
.emoji-invoker {
    top: 0.3rem;
}
.iconemoji{
    position: relative;
    width: 70px;
}
.files{
    position: relative;
    width: 100%;
    height: 150px;
    border-top: 1px solid;
}
.files img{
    position: relative;
    width: 200px;
    height: 140px;
    padding: 10px 10px 0px 10px;
}

.desactive {
    cursor: pointer;
}
.desactive:hover {
    color: var(--iq-primary-hover);
}
.hover {
    color: var(--iq-primary-hover);
}
</style>