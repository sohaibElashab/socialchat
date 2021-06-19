<template>
    <div>
        <ul class="post-comments p-0 m-0">
            <li class="mb-2" v-for="comment in comments" :key="comment.id">
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
                        <div
                            class="d-flex flex-wrap align-items-center comment-activity"
                        >
                            <a href="javascript:void();"><i class="ri-heart-line"></i></a>
                            <a href="javascript:void();"><i class="ri-edit-2-line"></i></a>
                            <a href="javascript:void();"><i class="ri-delete-bin-6-line"></i></a>
                            <span> {{ comment.time }} </span>
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
                    <label style=" cursor: pointer; " for="fileComment" ><i class="ri-link mr-3"></i></label>
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
            // comments: {
            //     "1": {
            //         id: 1,
            //         userImg: "images/user/01.jpg",
            //         userName: "testy Sthesia",
            //         text: "test 6",
            //         time: "Just Now"
            //     },
            //     "2": {
            //         id: 2,
            //         userImg: "images/user/03.jpg",
            //         userName: "Barb Ackue",
            //         statu: "ipsum dolor sit amet",
            //         time: "1 hour ago"
            //     }
            // },
            comments: [],
            file: null,
            fileUrl : null,
            search: "",
            myText: "",
        };
    },
    methods: {
        append(emoji) {
            this.myText += emoji;
        },
        showFile(e){
            // axios
            //     .post("/comment", {id: this.id} )
            //     .then(res => {
            //         console.log(res.data);
            //     })
            //     .catch(err => {
            //         console.log(err);
            //     });
            // console.log('fichier :' , e.target.files[0]);
            console.log('id :' , this.id);
            // document.getElementById("fileComment").value = null;
        },
        addComment(){
            if(this.myText != ""){
                axios
                    .post("/add-comment", {id: this.id , text : this.myText} )
                    .then(res => {
                        console.log(res.data);
                        this.comments.push(res.data);
                        this.myText = '';
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    },
    mounted(){
        axios
            .post("/get-comments", {id: this.id } )
            .then(res => {
                console.log(res.data);
                this.comments = res.data;
            })
            .catch(err => {
                console.log(err);
            });
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

</style>