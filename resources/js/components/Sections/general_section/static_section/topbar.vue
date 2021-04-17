<template>
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <NavLogo></NavLogo>
                  <NavSearch></NavSearch>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <NavItems></NavItems>
               </nav>
            </div>
         </div>
</template>

<script>

import NavLogo from '../../single_section/NavLogo'
import NavSearch from '../../single_section/NavSearch'
import NavItems from '../../single_section/NavItems'

export default {
   components: {
      NavLogo,
      NavSearch,
      NavItems
   }
}
</script>