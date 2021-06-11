<template>
    <div id="content-page" class="content-page">
        <div class="container" v-if="videos != null && videos.length > 0">
            <div class="row">
                <div
                    class="col-md-6 col-lg-4 mb-3"
                    v-for="video in videos"
                    :key="video.id"
                >
                    <div class="user-images position-relative overflow-hidden">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe
                                class="embed-responsive-item"
                                :src="`videos/${video.name}`"
                                allowfullscreen
                            ></iframe>
                        </div>
                        <div class="image-hover-data">
                            <div class="product-elements-icon">
                                <ul
                                    class="d-flex align-items-center m-0 p-0 list-inline"
                                >
                                    <li>
                                        <a href="#" class="pr-3 text-white">
                                            {{ video.NbrJaime }}
                                            <i class="ri-thumb-up-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="pr-3 text-white">
                                            {{ video.NbrComment }}
                                            <i class="ri-chat-3-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="pr-3 text-white">
                                            {{ video.NbrPartage }}
                                            <i
                                                class="ri-share-forward-line"
                                            ></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a
                            href="#"
                            class="image-edit-btn"
                            data-toggle="tooltip"
                            data-placement="top"
                            title=""
                            data-original-title="Edit or Remove"
                            ><i class="ri-edit-2-fill"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header-image">
                                <div class="profile-info p-4">
                                    <div class="user-detail">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-start"
                                        >
                                            <h6>
                                                You have no videos
                                            </h6>
                                        </div>
                                    </div>
                                </div>
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
            videos: null
        };
    },
    mounted() {
        axios.get("/videosProfile").then(res => {
            this.videos = res.data;
        });
    }
};
</script>
