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

            <div class="header-for-bg">
                <div class="background-header position-relative">
                    <img
                        src="images/page-img/profile-bg5.jpg"
                        class="img-fluid rounded w-100 rounded rounded"
                        alt="profile-bg"
                    />
                    <div class="title-on-header">
                        <div class="data-block">
                            <h2>Your Videos</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content  -->
            <contentVideos />
            <!-- Page Content End -->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
    </div>
</template>

<script>
import contentVideos from "../Sections/general_section/dynamic_section/contentVideos.vue";
export default {
    components: {
        contentVideos
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
