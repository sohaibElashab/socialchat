<template>
         <div class="right-sidebar-mini right-sidebar">
            <div class="right-sidebar-panel p-0">
               <div class="iq-card shadow-none">
                  <div class="iq-card-body p-0">
                     <div class="media-height p-3">

                        <div class="media align-items-center mb-4" v-for="friend in friends" :key="friend.id">
                           <div class="iq-profile-avatar" :class="friend.statu">
                              <img class="rounded-circle avatar-50" :src="friend.img" alt="">
                           </div>
                           <div class="media-body ml-3">
                              <h6 class="mb-0">
                                 <!-- <a href="#">{{friend.name}}</a> -->
                                 <router-link tag="a" :to="friend.href">
                                    {{friend.name}}
                                 </router-link>
                              </h6>
                              <p class="mb-0">{{friend.time}}</p>
                           </div>
                        </div>
                     </div>
                     <div class="right-sidebar-toggle bg-primary mt-3">
                        <i class="ri-arrow-left-line side-left-icon"></i>
                        <i class="ri-arrow-right-line side-right-icon"><span class="ml-3 d-inline-block">Close Menu</span></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</template>

<script>
export default {
   data() {
      return {
         friends: {
            "1": {
                  id: 1,
                  statu: 'status-online',
                  href:"/",
                  img:"images/user/01.jpg", 
                  name:"Anna Sthesia", 
                  time:"Just Now"
            },
            "2": {
                  id: 2,
                  statu: 'status-online',
                  href:"/",
                  img:"images/user/02.jpg", 
                  name:"Paul Molive", 
                  time:"Just Now"
            },
            "3": {
                  id: 3,
                  statu: 'status-online',
                  href:"/",
                  img:"images/user/03.jpg", 
                  name:"Anna Mull", 
                  time:"Just Now"
            },
            "4": {
                  id: 4,
                  statu: 'status-online',
                  href:"/",
                  img:"images/user/04.jpg", 
                  name:"Paige Turner", 
                  time:"Just Now"
            },
            "5": {
                  id: 5,
                  statu: 'status-away',
                  href:"/",
                  img:"images/user/11.jpg", 
                  name:"Bob Frapples", 
                  time:"Just Now"
            },
            "6": {
                  id: 6,
                  statu: 'status-away',
                  href:"/",
                  img:"images/user/02.jpg", 
                  name:"Barb Ackue", 
                  time:"Just Now"
            },
            "7": {
                  id: 7,
                  statu: 'status-away',
                  href:"/",
                  img:"images/user/03.jpg", 
                  name:"Greta Life", 
                  time:"Just Now"
            },
            "8": {
                  id: 8,
                  statu: 'status-away',
                  href:"/",
                  img:"images/user/12.jpg", 
                  name:"Ira Membrit", 
                  time:"Just Now"
            },
            "9": {
                  id: 9,
                  statu: 'status-offline',
                  href:"/",
                  img:"images/user/01.jpg", 
                  name:"Pete Sariya", 
                  time:"Just Now"
            },
            "10": {
                  id: 10,
                  statu: 'status-offline',
                  href:"/",
                  img:"images/user/02.jpg", 
                  name:"Monty Carlo", 
                  time:"Just Now"
            },
         }
      }
   }
}
</script>