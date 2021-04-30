<template>
    <div class="container p-0">
        <div class="row no-gutters">
            <!-- sign details -->
                <sign-details/>
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
    }    
}
</script>