<template>
   <div class="iq-sidebar">
      <div id="sidebar-scrollbar">
         <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
               <li v-bind:class="{ active: menu.isActive }" v-for="menu in menus" :key="menu.id">
                  <router-link class="iq-waves-effect" :to="menu.href" tag="a" exact=""><i :class="menu.iClass"></i><span>{{menu.SpanName}}</span></router-link>
               </li> 
            </ul>
         </nav>
         <div class="p-3"></div>
      </div>
   </div>
</template>

<script>
console.log('wvswvvfwv')
export default {
   data() {
      return {
         menus: {
            "1": {
                  id: 1,
                  isActive: true,
                  href:"/",
                  iClass:"las la-newspaper", 
                  SpanName:"Newsfeed", 
            },
            "2": {
                  id: 2,
                  isActive: false,
                  href:"/profile",
                  iClass:"las la-user", 
                  SpanName:"Profile", 
            },
            "3": {
                  id: 3,
                  isActive: false,
                  href:"/Chat",
                  iClass:"lab la-rocketchat", 
                  SpanName:"Chat", 
            },
            "4": {
                  id: 4,
                  isActive: false,
                  href:"/Notification",
                  iClass:"las la-bell", 
                  SpanName:"Notification", 
            },
            "5": {
                  id: 5,
                  isActive: false,
                  href:"Profile-Video",
                  iClass:"las la-video", 
                  SpanName:"Profile Video", 
            },
            "6": {
                  id: 6,
                  isActive: false,
                  href:"/Profile-Image",
                  iClass:"las la-image", 
                  SpanName:"Profile Image", 
            },
            "7": {
                  id: 7,
                  isActive: false,
                  href:"/Firend-Request",
                  iClass:"las la-anchor", 
                  SpanName:"Friend Request", 
            },
            "8": {
                  id: 8,
                  isActive: false,
                  href:"/friend-list",
                  iClass:"las la-user-friends", 
                  SpanName:"Friend Lists", 
            },
            "9": {
                  id: 9,
                  isActive: false,
                  href:"/Blog",
                  iClass:"ri-grid-line", 
                  SpanName:"Blog", 
            },
            "10": {
                  id: 10,
                  isActive: false,
                  href:"/Sign-out",
                  iClass:"ri-login-box-line", 
                  SpanName:"Sign out", 
            },
         }
      }
   }
}
</script>