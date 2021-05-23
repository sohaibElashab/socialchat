<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <contentVerifyEmail />
        </section>
    </div>
</template>

<script>
import contentVerifyEmail from "./../Sections/general_section/dynamic_section/contentVerifyEmail";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        contentVerifyEmail,
        CircleSign
    }
};
</script>
