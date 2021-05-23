<template>
    <div>
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <CircleSign />
            <contentResetPass />
        </section>
    </div>
</template>

<script>
import contentResetPass from "./../Sections/general_section/dynamic_section/contentResetPass";
import CircleSign from "./../Sections/single_section/CircleSign";
export default {
    components: {
        contentResetPass,
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
