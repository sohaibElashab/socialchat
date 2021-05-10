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
            <contentProfile :user="user" />
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
    components: {
        contentProfile
    },
    data() {
        return {
            user: null
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            console.log(res.data);
            this.user = res.data;
        });
    }
};
</script>
