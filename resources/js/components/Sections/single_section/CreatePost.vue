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
                <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded-circle">
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
                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                </div>
                <div class="modal-body">
                   <div class="d-flex align-items-center">
                      <div class="user-img">
                         <img src="images/user/1.jpg" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                      </div>
                      <form class="post-text ml-3 w-100" action="javascript:void();">
                         <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                      </form>
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
                         <div class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</div>
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
export default {
}
</script>