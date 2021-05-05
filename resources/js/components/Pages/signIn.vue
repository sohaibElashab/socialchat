<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign/>
            <containerSignin/>
        </section>
    </div>
</template>

<script>
import containerSignin from './../Sections/general_section/dynamic_section/containerSignin'
import CircleSign from './../Sections/single_section/CircleSign'
export default {
    components: {
        containerSignin,
        CircleSign
    }
}
</script>