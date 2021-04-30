<template>
    <div class="col-md-6 text-center pt-5">
        <div class="sign-in-detail text-white">
            <a class="sign-in-logo mb-5" href="#"
                ><img
                    src="images/logo-full.png"
                    class="img-fluid"
                    alt="logo"
            /></a>
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
    data() {
        return {
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
            }
        }
    }
}
</script>