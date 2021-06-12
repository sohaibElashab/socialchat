<template>
    <div class="tab-pane fade" id="photos" role="tabpanel">
        <div class="iq-card">
            <div class="iq-card-body">
                <h2>Photos</h2>
                <div class="friend-list-tab mt-2">
                    <div class="tab-content">
                        <div
                            class="tab-pane fade active show"
                            id="photosofyou"
                            role="tabpanel"
                        >
                            <div class="iq-card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-md-6 col-lg-3 mb-3"
                                        v-for="(image , index) in images"
                                        :key="index"
                                    >
                                        <div class="user-images position-relative overflow-hidden">
                                            <a href="#" v-if="image.type != 'post'">
                                                <img
                                                    :src="`images/user/${image.name}`"
                                                    class="rounded"
                                                    alt="Responsive image"
                                                    style="width: 224px ; height: 200px;"
                                                />
                                            </a>
                                            <a href="#" v-else>
                                                <img
                                                    :src="`images/posts/${id}/${image.name}`"
                                                    class="rounded"
                                                    alt="Responsive image"
                                                    style="width: 224px ; height: 200px;"
                                                />
                                            </a>
                                            <div class="image-hover-data">
                                                <div class="product-elements-icon">
                                                    <ul
                                                        class="d-flex align-items-center m-0 p-0 list-inline"
                                                    >
                                                        <li>
                                                            <a href="#" class="pr-3 text-white">
                                                                {{ image.NbrJaime }}
                                                                <i class="ri-thumb-up-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="pr-3 text-white">
                                                                {{ image.NbrComment }}
                                                                <i class="ri-chat-3-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="pr-3 text-white">
                                                                {{ image.NbrPartage }}
                                                                <i class="ri-share-forward-line"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        images: {
            require: true
        },
        id:{
            require: true            
        }
    }
};
</script>
