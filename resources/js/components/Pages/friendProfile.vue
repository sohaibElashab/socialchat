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
            <contentfriendProfile :UserId="id" v-if="isMounted" />
            <!-- Page Content End -->
        </div>
        <!-- Wrapper END -->
        <bottombar />
        <!-- Footer -->
    </div>
</template>

<script>
import contentfriendProfile from "../Sections/general_section/dynamic_section/contentfriendProfile.vue";
export default {
    props: ["id"],
    components: {
        contentfriendProfile
    },
    data() {
        return {
            isMounted: false
        };
    },
    mounted() {
        /*  if (this.id != null) {
            this.welcome = this.id;
            console.log("profile");
            console.log(this.id);
        }
         */
        if (this.id != null) {
            this.isMounted = true;
        }
    },
    watch: {
        id: function() {
            if (this.id != null) {
                this.isMounted = true;
            }
        }
    }
};
</script>
