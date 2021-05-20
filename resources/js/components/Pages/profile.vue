<template>
    <div>
        <!-- Wrapper Start -->
        <div class="wrapper">
            <!-- Sidebar  -->
            <sidebar />
            <!-- Sidebar End  -->

            <!-- TOP Nav Bar -->
            <topbar />
            <!-- TOP Nav Bar END -->

            <!-- Right Sidebar Panel Start-->
            <rightbar />
            <!-- Right Sidebar Panel End-->

            <!-- Page Content  -->
            <contentProfile :UserId="id" v-if="isMounted" />
            <!-- Page Content End -->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
    </div>
</template>

<script>
import contentProfile from "./../Sections/general_section/dynamic_section/contentProfile.vue";
export default {
    props: ["id"],
    components: {
        contentProfile
    },
    data() {
        return {
            isMounted: false
        };
    },
    mounted() {
        console.log("profile mounted   " + this.id);
        this.isMounted = true;
    },
    watch: {
        id: function() {
            console.log("profile watch   " + this.id);
            this.isMounted = true;
        }
    }

    /* ,
    beforeRouteEnter(to, from, next) {
        // called before the route that renders this component is confirmed.
        // does NOT have access to `this` component instance,
        // because it has not been created yet when this guard is called!

        axios
            .get("/profile")
            .then(res => {
                next();
            })
            .catch(err => {
                next({
                    name: "signIn"
                });
            });
    } */
};
</script>
