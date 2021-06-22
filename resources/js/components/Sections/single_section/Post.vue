<template>
    <div class="iq-card iq-card-block iq-card-stretch" v-if="post">
        <div class="iq-card-body">
            <div class="iq-card-header d-flex justify-content-between mb-4" v-if="isPost">
                <div class="iq-header-title" @click="comeBack">
                    <h6 class="card-title" style="cursor: pointer;">
                        <i class="ri-arrow-left-fill" style=" font-size: 25px; "></i>
                        Back to previous page
                    </h6>
                </div>
            </div>
            <div class="user-post-data">
                <div class="d-flex flex-wrap">
                    <div class="media-support-user-img mr-3">
                        <img
                            class="rounded-circle img-fluid"
                            v-if="post.userImg"
                            :src="`images/user/${post.userImg}`"
                            alt=""
                        />
                    </div>
                    <div class="media-support-info mt-2">
                        <h5 class="mb-0 d-inline-block">
                            <router-link
                                tag="a"
                                :to="{
                                    name: 'profile',
                                    query: { user: post.user_id }
                                }"
                                class=""
                                v-if="post.userName"
                                >{{ post.userName }}</router-link
                            >
                        </h5>
                        <p class="mb-0 d-inline-block" v-if="post.statu">
                            {{ post.statu }}
                        </p>
                        <p class="mb-0 text-primary" v-if="post.time">
                            {{ post.time }}
                        </p>
                    </div>
                    <div class="iq-card-post-toolbar">
                        <router-link
                            tag="span"
                            :to="{
                                name: 'postEdit',
                                query: { postId: post.id }
                            }"
                            class="dropdown-toggle"
                            v-if="post.edit"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            role="button"
                        >
                            <i class=" ri-edit-2-line"></i>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="mt-3" v-if="post.text">
                <p>{{ post.text }}</p>
            </div>
            <div
                class="user-post"
                v-if="Object.keys(post.postImgs).length > 0"
                style="text-align: -webkit-center;"
            >
                <div v-if="Object.keys(post.postImgs).length > 1">
                    <splide :options="options">
                        <splide-slide
                            v-for="(imgs, index) in post.postImgs"
                            :key="index"
                            style="border-radius: 5px;"
                        >
                            <img
                                :src="`images/posts/${post.user_id}/${imgs}`"
                            />
                        </splide-slide>
                    </splide>
                </div>
                <div v-else class="user-post text-center">
                    <a href="javascript:void();"
                        ><img
                            :src="
                                `images/posts/${post.user_id}/${post.postImgs[0]}`
                            "
                            alt="post-image"
                            class="postImg"
                    /></a>
                </div>
            </div>
            <div class="user-post" v-if="post.postVds">
                <div class="embed-responsive embed-responsive-16by9">
                    <video controls>
                        <source
                            :src="
                                `videos/posts/${post.user_id}/${post.postVds}`
                            "
                            type="video/mp4"
                        />
                        <source
                            :src="
                                `videos/posts/${post.user_id}/${post.postVds}`
                            "
                            type="video/webm"
                        />
                        <p>
                            Votre navigateur ne prend pas en charge les vidéos
                            HTML5. Voici
                            <a
                                :href="
                                    `videos/posts/${post.user_id}/${post.postVds}`
                                "
                                >un lien pour télécharger la vidéo</a
                            >.
                        </p>
                    </video>
                </div>
            </div>
            <div class="user-post" v-if="post.type == 'profile'">
                <div class="user-post text-center mt-3">
                    <img
                        :src="`images/user/${post.userImg}`"
                        alt="post-image"
                        class="postImg"
                    />
                </div>
            </div>
            <div class="user-post" v-if="post.type == 'cover'">
                <div class="user-post text-center mt-3">
                    <img
                        :src="`images/user/${post.userCover}`"
                        alt="post-image"
                        class="postImg"
                    />
                </div>
            </div>
            <div class="comment-area mt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div
                        class="like-block position-relative d-flex align-items-center"
                    >
                        <div class="total-like-block ml-2 mr-3">
                            <span
                                role="button"
                                :class="{ save: post.postLike }"
                                @click="isLike()"
                            >
                                <i
                                    :class="{
                                        'ri-heart-line': !post.postLike,
                                        'ri-heart-fill': post.postLike
                                    }"
                                    id="Ilike"
                                ></i>
                                {{ post.numbers.likes }}
                            </span>
                        </div>
                        <div class="total-like-block ml-2 mr-3">
                            <router-link tag="span" :to="{ name: 'post', query: { postId: post.id } }" :class="{ save: post.postComment }">
                                <i
                                    :class="{
                                        'ri-discuss-line': !post.postComment,
                                        'ri-discuss-fill': post.postComment
                                    }"
                                ></i>
                                {{ post.numbers.comments }}
                            </router-link>
                        </div>
                        <div class="total-like-block ml-2 mr-3">
                            <span @click="sharePost">
                                <i class="las la-share"></i>
                                {{ post.numbers.shares }}
                            </span>
                        </div>
                    </div>
                    <div
                        class="share-block d-flex align-items-center feather-icon mr-3"
                    >
                        <div>
                            <span
                                class="desactive"
                                :class="{ save: post.postSave }"
                                @click="save()"
                            >
                                <i
                                    :class="{
                                        'ri-bookmark-line': !post.postSave,
                                        'ri-bookmark-fill': post.postSave
                                    }"
                                ></i>
                                <span class="ml-1">save</span>
                            </span>
                        </div>
                    </div>
                </div>
                <hr />
                <Comment :id="post.id" @changeNumbers="NumbersComment"/>
            </div>
        </div>
    </div>
</template>

<script>
import "@splidejs/splide/dist/css/themes/splide-skyblue.min.css";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import Comment from "./Comment";
import EventBus from "../../../event-bus";

export default {
    components: {
        Splide,
        SplideSlide,
        Comment
    },
    props: {
        post: {
            type: Object,
            require: true
        }
    },
    data() {
        return {
            options: {
                rewind: true,
                width: 650,
                height: 400,
                cover: true,
                perPage: 1,
                gap: 0,
                padding: 0,
                type: "fade",
                focus: 2
            },
            posts: null
        };
    },
    mounted() {
        Echo.private(`sharePost.${this.post.id}`).listen(
            "SharePostEvent",
            e => {
                this.share += 1;
            }
        );
        Echo.private(`likePost.${this.post.id}`).listen(
            'likePostEvent',
            e => {
                if(e.id == this.post.id){
                    e.etat ? --this.post.numbers.likes : ++this.post.numbers.likes ; 
                }
            }
        )
    },
    methods: {
        sharePost() {
            EventBus.$emit("postID", this.post.id);
            document.getElementById("SharePostWrap").style.display = "flex";
            document.body.style.overflowY = "hidden";
        },
        async save() {
            await axios
                .post("/save-post", {
                    id: this.post.id,
                    etat: this.post.postSave
                })
                .then(res => {
                    this.$emit("unsavePost");
                })
            if (this.$route.name != "Saved") {
                this.post.postSave = !this.post.postSave;
            }
        },
        async isLike() {
            await axios
                .post("/like-post", {
                    id: this.post.id,
                    etat: this.post.postLike
                })
                .then(res => {
                    this.post.numbers.likes = res.data.likes;
                })
            this.post.postLike = !this.post.postLike;
        },
        NumbersComment(etat){
            etat ? ++this.post.numbers.comments : --this.post.numbers.comments ;
        },
        comeBack() {
            this.$router.back();
        },
    },
    computed: {
        isPost() {
            return this.$route.name === 'post';
        }
    }
};
</script>

<style scoped>
.desactive {
    cursor: pointer;
}
.desactive:hover {
    color: var(--iq-primary-hover);
}
.save {
    color: var(--iq-primary-hover);
}
.postImg {
    position: relative;
    width: 87%;
    border-radius: 5px;
}
</style>
