<template>
            <div id="content-page" class="content-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3" v-for="image in images" :key="image.id">
                            <div
                                class="user-images position-relative overflow-hidden"
                            >
                                <a href="#">
                                    <img
                                        :src="`images/user/${image.name}`"
                                        class="img-fluid-images rounded"
                                        alt="Responsive image"
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
                            </div>
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