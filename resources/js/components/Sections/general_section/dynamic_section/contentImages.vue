<template>
            <div id="content-page" class="content-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3" v-for="image in images" :key="image.id">
                            <router-link 
                                tag="div" :to="{ name: 'post', query: { postId: image.post_id } }" 
                                class="user-images position-relative overflow-hidden"
                            >
                                <a href="#" v-if="image.type != 'post'">
                                    <img
                                        :src="`images/user/${image.name}`"
                                        class="rounded"
                                        alt="Responsive image"
                                        style="width: 313px ; height: 250px;"
                                    />
                                </a>
                                <a href="#" v-else>
                                    <img
                                        :src="`images/posts/${image.user_id}/${image.name}`"
                                        class="rounded"
                                        alt="Responsive image"
                                        style="width: 313px ; height: 250px;"
                                    />
                                </a>
                                <div class="image-hover-data">
                                    <div class="product-elements-icon">
                                        <ul
                                            class="d-flex align-items-center m-0 p-0 list-inline"
                                        >
                                            <li>
                                                <a
                                                    href="#"
                                                    class="pr-3 text-white"
                                                >
                                                    {{image.NbrJaime}}
                                                    <i
                                                        class="ri-thumb-up-line"
                                                    ></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="#"
                                                    class="pr-3 text-white"
                                                >
                                                    {{image.NbrComment}}
                                                    <i
                                                        class="ri-chat-3-line"
                                                    ></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="#"
                                                    class="pr-3 text-white"
                                                >
                                                    {{image.NbrPartage}}
                                                    <i
                                                        class="ri-share-forward-line"
                                                    ></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <router-link
                                    v-if="image.type == 'post'"
                                    tag="a"
                                    :to="{ name: 'postEdit', query: { postId: image.post_id } }"
                                    class="image-edit-btn"
                                    ><i class="ri-edit-2-fill"></i
                                ></router-link> 
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    data() {
        return {
            images : null
        }
    },
    mounted() {
        axios.get("/imagesProfile").then(res => {
            this.images = res.data;
        });
    }
}
</script>