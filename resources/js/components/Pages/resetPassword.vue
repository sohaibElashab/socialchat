<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <containerResetPass />
        </section>
    </div>
</template>

<script>
import containerResetPass from "./../Sections/general_section/dynamic_section/containerResetPass";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        containerResetPass,
        CircleSign
    },
    beforeRouteEnter(to, from, next) {
        //console.log("aa");
        axios
            .get("/GatHashed")
            .then(res => {
                console.log(res.data === to.query.token);
                if (res.data === to.query.token) {
                    next();
                } else {
                    next({
                        name: "signIn"
                    });
                }
            })
            .catch(err => {
                next({
                    name: "signIn"
                });
            });
    }
};
</script>
