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
            <contentProfile />
            <!-- Page Content End -->
            <!--  :UserId="id" v-if="isMounted"-->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
        <SharePost />
    </div>
</template>

<script>
import contentProfile from "./../Sections/general_section/dynamic_section/contentProfile.vue";
import SharePost from "../Sections/single_section/SharePost.vue";
export default {
    components: {
        contentProfile,
        SharePost
    },
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
    }
};
</script>

<style>
.SharePostWrap {
    position: fixed;
    z-index: 10001;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.295);
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
