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
            <div class="header-for-bg">
                <div class="background-header position-relative">
                    <img
                        src="images/page-img/profile-bg9.jpg"
                        class="img-fluid rounded w-100 rounded rounded"
                        alt="profile-bg"
                    />
                    <div class="title-on-header">
                        <div class="data-block">
                            <h2>Your Saved Posts</h2>
                        </div>
                    </div>
                </div>
            </div>
            <containerPostSave />
            <!-- Page Content End -->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
    </div>
</template>

<script>
import containerPostSave from "../Sections/general_section/dynamic_section/containerPostSave";
export default {
    components: {
        containerPostSave
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
