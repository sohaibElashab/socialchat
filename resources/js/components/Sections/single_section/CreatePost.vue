<template>

   <div id="post-modal-data" class="iq-card iq-card-block iq-card-stretch">
      <div class="iq-card-header d-flex justify-content-between">
         <div class="iq-header-title">
            <h4 class="card-title">Create Post</h4>
         </div>
      </div>
      <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
         <div class="d-flex align-items-center">
            <div class="user-img">
               <img :src="`images/user/${user.profileimg.name}`" alt="userimg" class="avatar-60 rounded-circle">
            </div>
            <form class="post-text ml-3 w-100" action="javascript:void();">
               <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
            </form>
         </div>
         <hr>
         <ul class="post-opt-block d-flex align-items-center list-inline m-0 p-0">
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo</li>
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Video</li>
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</li>
         </ul>
      </div>
      <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
               </div>
               <div class="modal-body">
                  <div class="d-flex flex-column bd-highlight">
                     <div class="bd-highlight mb-2">
                           <div class="d-flex flex-wrap">
                           <div class="media-support-user-img mr-3">
                              <img class="rounded-circle img-fluid" :src="`images/user/${user.profileimg.name}`" alt="">
                           </div>
                           <div class="media-support-info mt-2">
                              <h5 class="mb-0 d-inline-block">{{user.name}}</h5>
                              <p class="mb-0 text-primary">post.statu</p>
                           </div>
                           <div class="iq-card-post-toolbar">
                              <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                 <i data-dismiss="modal" class="ri-close-fill"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="bd-highlight justify-content-center mt-2">
                        <form class="post-text ml-3" action="javascript:void();">
                           <!-- <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;"> -->
                           <VueEmoji ref="emoji" @input="onInput" height="100" class="emoji-div -create" :value="myText" />
                        </form>
                     </div>
                  </div> 
                  <hr>
                  <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                     <li class="col-md-12 mb-3">
                        <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/07.png" alt="icon" class="img-fluid"> Photo</div>
                     </li>
                     <li class="col-md-12 mb-3">
                        <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/08.png" alt="icon" class="img-fluid"> Video</div>
                     </li>
                     <li class="col-md-12 mb-3">
                        <!-- <div class="iq-bg-primary rounded p-2 pointer mr-3" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                           <img src="images/small/09.png" alt="icon" class="img-fluid"> 
                           Feeling/Activity
                        </div> -->
                        <p>
                          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Link with href
                          </a>
                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Button with data-target
                          </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                     </li>
                  </ul>
                  <button type="submit" class="btn btn-primary d-block w-100 mt-3">Post</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import VueEmoji from 'emoji-vue'
export default {
   data(){
      return{
         user:null
      }
   },
   methods: {
      onInput(event) {
          //event.data contains the value of the textarea
         console.log(event.data)
      },
      clearTextarea(){
         this.$refs.emoji.clear()
      },  
   },
   components: {
      VueEmoji
   },
   mounted(){
      axios.get("/profile").then(res => {
         this.user = res.data;
      });
   }
}
</script>
