<template>
    <div class="col-md-6 text-center pt-5">
        <div class="sign-in-detail text-white">
            <div class="sign-in-logo mb-5"
                ><img
                    src="images/logo-full.png"
                    class="img-fluid"
                    alt="logo"
            /></div>
            <div>
                
                <splide :options="options">
                    <splide-slide v-for="item in items" :key="item.id">
                        <img
                            :src="item.imgItem"
                        />
                    </splide-slide>
                </splide>
            </div>
            <!-- <div
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
            </div> -->
        </div>
    </div>
</template>

<script>

import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
export default {
    components: {
        Splide, SplideSlide
    },
    props: {
        items: {
            type: Object,
            require: true
        }
    },
    data() {
        return{
            options: {
               rewind : true,
               width  : 650,
               height  : 400,
	            cover  : true,
               perPage : 1,
               gap : 0,
               padding : 0,
               type : 'fade',
	            focus  : 2,
            }
        }
    }
}
</script>