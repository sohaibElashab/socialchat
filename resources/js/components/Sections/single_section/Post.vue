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
            <Comment :id="post.id" @unsave="updateSave" />
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
            }
        };
    },
    methods: {
        updateSave(data) {
            this.$emit("unsavePost", data);
        }
    }
};
</script>
