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
            <contentProfileEdit />
            <!-- Page Content End -->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
    </div>
</template>

<script>
import contentProfileEdit from "./../Sections/general_section/dynamic_section/contentProfileEdit.vue";
export default {
    components: {
        contentProfileEdit
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
