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
    }
};
</script>
