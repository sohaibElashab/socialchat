<template>
    <div class="col-md-6 text-center pt-5">
        <div class="sign-in-detail text-white">
            <div class="sign-in-logo mb-3"
                ><img
                    src="images/logo-full.png"
                    class="img-fluid"
                    alt="logo"
            /></div>
            <div>
                <splide :options="options">
                    <splide-slide v-for="item in items" :key="item.id">
                        <div class="contentDetails">
                            <div class="contentImg">
                                <img
                                :src="item.imgItem"
                                />
                            </div>
                            <div class="contentText">
                                <h4 class="mb-1 text-white">
                                {{item.titleItem}}
                                </h4>
                                <p>
                                    {{item.textItem}}
                                </p>
                            </div>
                        </div>
                    </splide-slide>
                </splide>
            </div>
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
    data() {
        return{
            items : {
                "1" : {
                    id: 1,
                    imgItem: "images/login/1.png",
                    titleItem : "Find new friends",
                    textItem: "Forge new friendships with people that share your interests"
                },
                "2" : {
                    id: 2,
                    imgItem: "images/login/2.png",
                    titleItem : "Connect with the world",
                    textItem: "Share your life with others from all around the world with only one click"
                },
                "3" : {
                    id: 3,
                    imgItem: "images/login/3.png",
                    titleItem : "Create new posts",
                    textItem: "Express your opinions and hobbies with your friends from the comfort of your home"
                },
            },
            options: {
                rewind : true,
                width  : 550,
                height  : 320,
	            cover  : true,
                perPage : 1,
                gap : 0,
                padding : 0,
                type : 'fade',
	            focus  : 2,
                arrows : false,
                autoplay : true

            }
        }
    }
}
</script>

<style>
.contentDetails{
    position: relative;
}
.contentImg > img {
    width  : 100%;
    height  : 100%;
}
.contentImg {
    width  : 100%;
    height  : 200px;
}
</style>