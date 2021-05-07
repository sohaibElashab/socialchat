<template>
    <div class="row">
        <div
            class="col-md-6 col-lg-3 mb-3"
            v-for="ProfileImage in ProfileImages"
            :key="ProfileImage.id"
        >
            <div class="user-images position-relative overflow-hidden">
                <a href="#">
                    <img
                        :src="ProfileImage.PrfImg"
                        class="img-fluid rounded"
                        alt="Responsive image"
                    />
                </a>
                <div class="image-hover-data">
                    <div class="product-elements-icon">
                        <ul
                            class="d-flex align-items-center m-0 p-0 list-inline"
                        >
                            <li>
                                <a href="#" class="pr-3 text-white">
                                    {{ ProfileImage.likeNbr }}
                                    <i class="ri-thumb-up-line"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="pr-3 text-white">
                                    {{ ProfileImage.CommentNbr }}
                                    <i class="ri-chat-3-line"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="pr-3 text-white">
                                    {{ ProfileImage.ShareNbr }}
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
</template>

<script>
export default {
    props: {
        ProfileImages: {
            type: Object,
            require: true
        }
    }
};
</script>
