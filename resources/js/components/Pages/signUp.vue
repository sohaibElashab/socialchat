<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign/>
            <containerSignup/>
        </section>
    </div>
</template>

<script>
import containerSignup from './../Sections/general_section/dynamic_section/containerSignup.vue'
import CircleSign from './../Sections/single_section/CircleSign'
export default {
    components: {
        containerSignup,
        CircleSign
    }
}
</script>