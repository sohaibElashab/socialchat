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
            <contentfriendProfile :user="user" />
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
    components: {
        contentfriendProfile
    },
    data() {
        return {
            user: null
        };
    },
    created() {
        axios
            .post("/FriendProfile", {
                id: this.$route.query.id
            })
            .then(res => {
                console.log(res.data);
                this.user = res.data;
            });
    },
    watch: {
        "$route.query.id": function() {
            this.load();
        }
    },
    methods: {
        load() {
            axios
                .post("/FriendProfile", {
                    id: this.$route.query.id
                })
                .then(res => {
                    console.log(res.data);
                    this.user = res.data;
                });
        }
    }
};
</script>
