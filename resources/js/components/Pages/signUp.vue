<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <contentSignup />
        </section>
    </div>
</template>

<script>
import contentSignup from "../Sections/general_section/dynamic_section/contentSignup.vue";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        contentSignup,
        CircleSign
    },
    beforeRouteEnter(to, from, next) {
        // called before the route that renders this component is confirmed.
        // does NOT have access to `this` component instance,
        // because it has not been created yet when this guard is called!

        axios
            .get("/profile")
            .then(res => {
                next({
                    name: "home"
                });
            })
            .catch(err => {
                next();
            });
    }
};
</script>
