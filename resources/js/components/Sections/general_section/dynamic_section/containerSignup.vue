<template>
    <div class="container p-0">
        <div class="row no-gutters">
            <!-- sign details -->
                <sign-details/>
            <!-- sign in form  -->
                <SignUpForm/>
        </div>
    </div>
</template>

<script>
import SignDetails from '../../single_section/SignDetails.vue'
import SignUpForm from '../../single_section/SignUpForm.vue'

export default {
    components:{
        SignDetails,
        SignUpForm
    }    
}
</script>