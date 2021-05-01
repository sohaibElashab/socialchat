<template>
    <div class="col-md-6 text-center pt-5">
        <div class="sign-in-detail text-white">
            <div class="sign-in-logo mb-5"
                ><img
                    src="images/logo-full.png"
                    class="img-fluid"
                    alt="logo"
            /></div>
            <div
                class="owl-carousel"
                data-autoplay="true"
                data-loop="true"
                data-nav="false"
                data-dots="true"
                data-items="1"
                data-items-laptop="1"
                data-items-tab="1"
                data-items-mobile="1"
                data-items-mobile-sm="1"
                data-margin="0"
            >
                <div class="item" v-for="item in items" :key="item.id">
                    <img
                        :src="item.imgItem"
                        class="img-fluid mb-4"
                        alt="logo"
                    />
                    <h4 class="mb-1 text-white">
                        {{item.titleItem}}
                    </h4>
                    <p>
                        {{item.textItem}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Object,
            require: true
        }
    }
}
</script>