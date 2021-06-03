<template>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <NavLogo></NavLogo>
                <NavSearch :show="show"></NavSearch>
                <button
                    class="navbar-toggler"
                    type="button"
                    v-on:click="showCollapse()"
                >
                    <i class="ri-menu-3-line"></i>
                </button>
                <NavItems :show="show"></NavItems>
            </nav>
        </div>
    </div>
</template>

<script>
import NavLogo from "../../single_section/NavLogo";
import NavSearch from "../../single_section/NavSearch";
import NavItems from "../../single_section/NavItems";

export default {
    /*     props: {
        user: {
            type: Object,
            required: true
        }
    }, */
    components: {
        NavLogo,
        NavSearch,
        NavItems
    },
    data(){
        return{
            show:false
        }
    },
    methods:{
        showCollapse() {
            this.show = !this.show;
        }
    } 
};
</script>
