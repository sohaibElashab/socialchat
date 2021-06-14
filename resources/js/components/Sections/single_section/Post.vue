<template>
    <div class="iq-card iq-card-block iq-card-stretch" v-if="post">
        <div class="iq-card-body">
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
                            class="img-fluid rounded w-100"
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
                        class="img-fluid rounded w-100 "
                    />
                </div>
            </div>
            <div class="user-post" v-if="post.type == 'cover'">
                <div class="user-post text-center mt-3">
                    <img
                        :src="`images/user/${post.userCover}`"
                        alt="post-image"
                        class="img-fluid rounded w-100 "
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
                                :class="{ save: liked }"
                                @click="isLike()"
                            >
                                <i class="ri-heart-line" id="Ilike"></i>
                                <!-- <i class="ri-heart-fill"></i> -->
                                {{ like }}
                            </span>
                        </div>
                        <div class="total-like-block ml-2 mr-3">
                            <span>
                                <i class="lar la-comments"></i> {{ comment }}
                            </span>
                        </div>
                        <div class="total-like-block ml-2 mr-3">
                            <span
                                ><i class="las la-share"></i> {{ share }}</span
                            >
                        </div>
                    </div>
                    <div
                        class="share-block d-flex align-items-center feather-icon mr-3"
                    >
                        <div>
                            <span
                                class="desactive"
                                :class="{ save: saved }"
                                @click="save()"
                            >
                                <i class="ri-bookmark-line" id="Ishare"></i>
                                <span class="ml-1">save</span>
                            </span>
                        </div>
                    </div>
                </div>
                <hr />
                <Comment />
            </div>
        </div>
    </div>
</template>

<script>
import "@splidejs/splide/dist/css/themes/splide-skyblue.min.css";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import Comment from "./Comment";

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
            saved: Boolean,
            liked: Boolean,
            posts: null,
            like: null,
            comment: null,
            share: null
        };
    },
    mounted() {
        axios
            .post("/check-post", { id: this.post.id })
            .then(res => {
                console.log("get check");
                console.log(res.data);
                this.saved = res.data.save;
                this.liked = res.data.like;
                this.changeclass(this.liked, null, this.saved);
            })
            .catch(err => {
                console.log(err);
            });
        axios
            .post("/get-numbers", { id: this.post.id })
            .then(res => {
                this.like = res.data.likes;
                this.comment = res.data.comments;
                this.share = res.data.shares;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        save() {
            console.log(this.post.id);
            if (this.saved) {
                axios
                    .post("/unsave-post", { id: this.post.id })
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
                this.$emit("unsavePost", true);
            } else {
                axios
                    .post("/save-post", { id: this.post.id })
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
            if (this.$route.name != "Saved") {
                this.saved = !this.saved;
            }
            this.changeclass(null, null, this.saved);
        },
        isLike() {
            if (this.liked) {
                axios
                    .post("/unlike-post", { id: this.post.id })
                    .then(res => {
                        console.log(res.data);
                        this.like = res.data.likes;
                        this.comment = res.data.comments;
                        this.share = res.data.shares;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                axios
                    .post("/like-post", { id: this.post.id })
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
            this.changeclass(this.liked, null, null);
        },
        changeclass(l, c, s) {
            if (l != null) {
                if (l) {
                    this.addremove("Ilike", "ri-heart-line", "ri-heart-fill");
                } else {
                    this.addremove("Ilike", "ri-heart-fill", "ri-heart-line");
                }
            }
            if (s != null) {
                if (s) {
                    this.addremove(
                        "Ishare",
                        "ri-bookmark-line",
                        "ri-bookmark-fill"
                    );
                } else {
                    this.addremove(
                        "Ishare",
                        "ri-bookmark-fill",
                        "ri-bookmark-line"
                    );
                }
            }
        },
        addremove(id, r, a) {
            document.getElementById(id).classList.remove(r);
            document.getElementById(id).classList.add(a);
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
</style>
