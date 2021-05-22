<template>
    <div class="row">
        <div
            class="col-md-6 col-lg-3 mb-3"
            v-for="image in images"
            :key="image.id"
        >
            <div class="user-images position-relative overflow-hidden">
                <a href="#">
                    <img
                        :src="`images/user/${image.name}`"
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
</template>

<script>
export default {
    props: {
        UserId: {
            require: true
        }
    },
    data() {
        return{
            images : []
        }
    },    
    mounted() {
        axios.post("/ProfileImages" , { id: this.UserId })
            .then(res => {
                this.images = res.data;
        });
    }
};
</script>
