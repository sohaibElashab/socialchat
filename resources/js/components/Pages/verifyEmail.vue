<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <containerVerifyEmail />
        </section>
    </div>
</template>

<script>
import containerVerifyEmail from "./../Sections/general_section/dynamic_section/containerVerifyEmail";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        containerVerifyEmail,
        CircleSign
    }
};
</script>
