<template>
   <div >
      <!-- khdam -->
      <!-- loader Start -->
      <loader/>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">

         <!-- Sidebar  -->
            <sidebar/>
         <!-- Sidebar End  -->

         <!-- TOP Nav Bar -->
            <topbar/>
         <!-- TOP Nav Bar END -->

         <!-- Right Sidebar Panel Start-->
            <rightbar/>
         <!-- Right Sidebar Panel End-->

         <!-- Page Content  -->
            <contentHome/>
         <!-- Page Content End -->

      </div>
      <!-- Wrapper END -->
         <bottombar/>
      <!-- Footer -->
   </div>
</template>

<script>
import contentHome from './../Sections/general_section/dynamic_section/contentHome.vue'
export default {
   components:{
      contentHome
   }
   
}
</script>