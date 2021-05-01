<template>
    <div class="row">
       <div class="col-md-6 col-lg-6 mb-3" v-for="FriendList in FriendLists" :key="FriendList.id">
          <div class="iq-friendlist-block">
             <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                   <a href="#">
                   <img :src="FriendList.FrdImg" alt="profile-img" class="img-fluid">
                   </a>
                   <div class="friend-info ml-3">
                      <h5>{{FriendList.FrdName}}</h5>
                      <p class="mb-0">{{FriendList.FrdNamber}}  friends</p>
                   </div>
                </div>
                <div class="iq-card-header-toolbar d-flex align-items-center">
                   <div class="dropdown">
                      <span class="dropdown-toggle btn btn-danger mr-2" id="dropdownMenuButton01" data-toggle="dropdown" aria-expanded="true" role="button">
                      <i class="ri-check-line mr-1 text-white font-size-16"></i> Unfriend
                      </span>
                   </div>
                </div>
             </div>
          </div>
        </div>
     </div>
</template>

<script>
export default {
    props: {
        FriendLists: {
            type: Object,
            require: true
        }
    }
}
</script>