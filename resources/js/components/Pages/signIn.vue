<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <contentSignin />
        </section>
    </div>
</template>

<script>
import contentSignin from "./../Sections/general_section/dynamic_section/contentSignin";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        contentSignin,
        CircleSign
    } /* ,
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
    } */
};
</script>
