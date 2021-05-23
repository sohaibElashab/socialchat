<template>
    <div class="container p-0">
        <div class="row no-gutters">
            <!-- sign details -->
                <SignDetails/>
            <!-- sign in form  -->
                <SignInForm/>
        </div>
    </div>
</template>

<script>
import SignDetails from '../../single_section/SignDetails.vue'
import SignInForm from '../../single_section/SignInForm.vue'

export default {
    components:{
        SignDetails,
        SignInForm
    }  ,  
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