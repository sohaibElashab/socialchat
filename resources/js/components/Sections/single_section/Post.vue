<template>
    <div>
        <div class="col-sm-12">
           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
              <div class="iq-card-body" v-for="post in posts" :key="post.id">
                 <div class="user-post-data">
                    <div class="d-flex flex-wrap">
                       <div class="media-support-user-img mr-3">
                          <img class="rounded-circle img-fluid" :src="post.userImg" alt="">
                       </div>
                       <div class="media-support-info mt-2">
                          <h5 class="mb-0 d-inline-block"><a href="#" class="">{{post.userName}}</a></h5>
                          <p class="mb-0 d-inline-block">{{post.statu}}</p>
                          <p class="mb-0 text-primary">{{post.time}}</p>
                       </div>
                       <div class="iq-card-post-toolbar">
                          <div class="dropdown">
                             <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                             <i class="ri-more-fill"></i>
                             </span>
                             <div class="dropdown-menu m-0 p-0">
                                <a class="dropdown-item p-3" href="#">
                                   <div class="d-flex align-items-top">
                                      <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                      <div class="data ml-2">
                                         <h6>Save Post</h6>
                                         <p class="mb-0">Add this to your saved items</p>
                                      </div>
                                   </div>
                                </a>
                                <a class="dropdown-item p-3" href="#">
                                   <div class="d-flex align-items-top">
                                      <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                      <div class="data ml-2">
                                         <h6>Hide Post</h6>
                                         <p class="mb-0">See fewer posts like this.</p>
                                      </div>
                                   </div>
                                </a>
                                <a class="dropdown-item p-3" href="#">
                                   <div class="d-flex align-items-top">
                                      <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                      <div class="data ml-2">
                                         <h6>Unfollow User</h6>
                                         <p class="mb-0">Stop seeing posts but stay friends.</p>
                                      </div>
                                   </div>
                                </a>
                                <a class="dropdown-item p-3" href="#">
                                   <div class="d-flex align-items-top">
                                      <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                      <div class="data ml-2">
                                         <h6>Notifications</h6>
                                         <p class="mb-0">Turn on notifications for this post</p>
                                      </div>
                                   </div>
                                </a>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="mt-3" v-if="post.text">
                    <p>{{post.text}}</p>
                 </div>

                  <div class="user-post" v-if="post.postImgs" style="text-align: -webkit-center;">
                     <div v-if="Object.keys(post.postImgs).length > 1" >
                        <splide :options="options">
                           <splide-slide v-for="imgs in post.postImgs" :key="imgs.img" style="border-radius: 5px;">
                              <img :src="imgs.img">
                           </splide-slide>
                        </splide>
                     </div>
                     <div v-else class="user-post text-center">
                        <a href="javascript:void();" v-for="imgs in post.postImgs" :key="imgs.img" ><img :src="imgs.img" alt="post-image" class="img-fluid rounded w-100"></a>
                     </div>
                  </div>
                 <div class="user-post" v-if="post.postVds">
                    <div class="embed-responsive embed-responsive-16by9">
                       <iframe class="embed-responsive-item" v-for="(vd,i) in post.postVds" :key="i" :src="vd" allowfullscreen></iframe>
                    </div>
                     <div v-if="Object.keys(post.postImgs).length > 1" >
                        <splide :options="options">
                           <splide-slide v-for="vds in post.postVds" :key="vds.vd" style="border-radius: 5px;">
                              <iframe class="embed-responsive-item" :src="vds.vd" allowfullscreen></iframe>
                           </splide-slide>
                        </splide>
                     </div>
                     <div v-else>
                       <iframe class="embed-responsive-item" v-for="vds in post.postVds" :key="vds.vd" :src="vds.vd" allowfullscreen></iframe>
                     </div>
                 </div>
                 <div class="comment-area mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                       <div class="like-block position-relative d-flex align-items-center">
                          <div class="d-flex align-items-center">
                             <div class="like-data">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   <img src="images/icon/01.png" class="img-fluid" alt="">
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                      <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                   </div>
                                </div>
                             </div>
                             <div class="total-like-block ml-2 mr-3">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   140 Likes
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Max Emum</a>
                                      <a class="dropdown-item" href="#">Bill Yerds</a>
                                      <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                      <a class="dropdown-item" href="#">Tara Misu</a>
                                      <a class="dropdown-item" href="#">Midge Itz</a>
                                      <a class="dropdown-item" href="#">Sal Vidge</a>
                                      <a class="dropdown-item" href="#">Other</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="total-comment-block">
                             <div class="dropdown">
                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                20 Comment
                                </span>
                                <div class="dropdown-menu">
                                   <a class="dropdown-item" href="#">Max Emum</a>
                                   <a class="dropdown-item" href="#">Bill Yerds</a>
                                   <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                   <a class="dropdown-item" href="#">Tara Misu</a>
                                   <a class="dropdown-item" href="#">Midge Itz</a>
                                   <a class="dropdown-item" href="#">Sal Vidge</a>
                                   <a class="dropdown-item" href="#">Other</a>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="share-block d-flex align-items-center feather-icon mr-3">
                          <a href="javascript:void();"><i class="ri-share-line"></i>
                          <span class="ml-1">99 Share</span></a>
                       </div>
                    </div>
                    <hr>
                    <ul class="post-comments p-0 m-0">
                       <li class="mb-2">
                          <div class="d-flex flex-wrap">
                             <div class="user-img">
                                <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                             </div>
                             <div class="comment-data-block ml-3">
                                <h6>Monty Carlo</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                <div class="d-flex flex-wrap align-items-center comment-activity">
                                   <a href="javascript:void();">like</a>
                                   <a href="javascript:void();">reply</a>
                                   <a href="javascript:void();">translate</a>
                                   <span> 5 min </span>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li>
                          <div class="d-flex flex-wrap">
                             <div class="user-img">
                                <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                             </div>
                             <div class="comment-data-block ml-3">
                                <h6>Paul Molive</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                <div class="d-flex flex-wrap align-items-center comment-activity">
                                   <a href="javascript:void();">like</a>
                                   <a href="javascript:void();">reply</a>
                                   <a href="javascript:void();">translate</a>
                                   <span> 5 min </span>
                                </div>
                             </div>
                          </div>
                       </li>
                    </ul>
                    <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                       <input type="text" class="form-control rounded">
                       <div class="comment-attagement d-flex">
                          <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                          <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                          <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                       </div>
                    </form>
                 </div>
              </div>
           </div>
        </div>
        <!-- <div class="col-sm-12">
              <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                 <div class="iq-card-body">
                    <div class="user-post-data">
                       <div class="d-flex flex-wrap">
                          <div class="media-support-user-img mr-3">
                             <img class="rounded-circle img-fluid" src="images/user/03.jpg" alt="">
                          </div>
                          <div class="media-support-info mt-2">
                             <h5 class="mb-0 d-inline-block"><a href="#" class="">Barb Ackue</a></h5>
                             <p class="mb-0 d-inline-block">Added New Image in a Post</p>
                             <p class="mb-0 text-primary">1 hour ago</p>
                          </div>
                          <div class="iq-card-post-toolbar">
                             <div class="dropdown">
                                <span class="dropdown-toggle" id="postdata-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <i class="ri-more-fill"></i>
                                </span>
                                <div class="dropdown-menu m-0 p-0" aria-labelledby="postdata-5">
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Save Post</h6>
                                            <p class="mb-0">Add this to your saved items</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Hide Post</h6>
                                            <p class="mb-0">See fewer posts like this.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Unfollow User</h6>
                                            <p class="mb-0">Stop seeing posts but stay friends.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Notifications</h6>
                                            <p class="mb-0">Turn on notifications for this post</p>
                                         </div>
                                      </div>
                                   </a>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="mt-3">
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                    </div>
                    <div class="user-post">
                       <a href="javascript:void();"><img src="images/page-img/p4.jpg" alt="post-image" class="img-fluid rounded w-100"></a>
                    </div>
                    <div class="comment-area mt-3">
                       <div class="d-flex justify-content-between align-items-center">
                          <div class="like-block position-relative d-flex align-items-center">
                             <div class="d-flex align-items-center">
                                <div class="like-data">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      <img src="images/icon/01.png" class="img-fluid" alt="">
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                      </div>
                                   </div>
                                </div>
                                <div class="total-like-block ml-2 mr-3">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      140 Likes
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="dropdown-item" href="#">Max Emum</a>
                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                         <a class="dropdown-item" href="#">Other</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="total-comment-block">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   20 Comment
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Max Emum</a>
                                      <a class="dropdown-item" href="#">Bill Yerds</a>
                                      <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                      <a class="dropdown-item" href="#">Tara Misu</a>
                                      <a class="dropdown-item" href="#">Midge Itz</a>
                                      <a class="dropdown-item" href="#">Sal Vidge</a>
                                      <a class="dropdown-item" href="#">Other</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="share-block d-flex align-items-center feather-icon mr-3">
                             <a href="javascript:void();"><i class="ri-share-line"></i>
                             <span class="ml-1">99 Share</span></a>
                          </div>
                       </div>
                       <hr>
                       <ul class="post-comments p-0 m-0">
                          <li class="mb-2">
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Monty Carlo</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                          <li>
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Paul Molive</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                       </ul>
                       <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                          <input type="text" class="form-control rounded">
                          <div class="comment-attagement d-flex">
                             <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>
        </div>
        <div class="col-sm-12">
              <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                 <div class="iq-card-body">
                    <div class="user-post-data">
                       <div class="d-flex flex-wrap">
                          <div class="media-support-user-img mr-3">
                             <img class="rounded-circle img-fluid" src="images/user/04.jpg" alt="">
                          </div>
                          <div class="media-support-info mt-2">
                             <h5 class="mb-0 d-inline-block"><a href="#" class="">Ira Membrit</a></h5>
                             <p class="mb-0 d-inline-block">Update her Status</p>
                             <p class="mb-0 text-primary">6 hour ago</p>
                          </div>
                          <div class="iq-card-post-toolbar">
                             <div class="dropdown">
                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <i class="ri-more-fill"></i>
                                </span>
                                <div class="dropdown-menu m-0 p-0">
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Save Post</h6>
                                            <p class="mb-0">Add this to your saved items</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Hide Post</h6>
                                            <p class="mb-0">See fewer posts like this.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Unfollow User</h6>
                                            <p class="mb-0">Stop seeing posts but stay friends.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Notifications</h6>
                                            <p class="mb-0">Turn on notifications for this post</p>
                                         </div>
                                      </div>
                                   </a>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="mt-3">
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                    </div>
                    <div class="comment-area mt-3">
                       <div class="d-flex justify-content-between align-items-center">
                          <div class="like-block position-relative d-flex align-items-center">
                             <div class="d-flex align-items-center">
                                <div class="like-data">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      <img src="images/icon/01.png" class="img-fluid" alt="">
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                      </div>
                                   </div>
                                </div>
                                <div class="total-like-block ml-2 mr-3">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      140 Likes
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="dropdown-item" href="#">Max Emum</a>
                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                         <a class="dropdown-item" href="#">Other</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="total-comment-block">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   20 Comment
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Max Emum</a>
                                      <a class="dropdown-item" href="#">Bill Yerds</a>
                                      <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                      <a class="dropdown-item" href="#">Tara Misu</a>
                                      <a class="dropdown-item" href="#">Midge Itz</a>
                                      <a class="dropdown-item" href="#">Sal Vidge</a>
                                      <a class="dropdown-item" href="#">Other</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="share-block d-flex align-items-center feather-icon mr-3">
                             <a href="javascript:void();"><i class="ri-share-line"></i>
                             <span class="ml-1">99 Share</span></a>
                          </div>
                       </div>
                       <hr>
                       <ul class="post-comments p-0 m-0">
                          <li class="mb-2">
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Monty Carlo</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                          <li>
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Paul Molive</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                       </ul>
                       <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                          <input type="text" class="form-control rounded">
                          <div class="comment-attagement d-flex">
                             <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>
        </div>
        <div class="col-sm-12">
              <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                 <div class="iq-card-body">
                    <div class="post-item">
                       <div class="d-flex flex-wrap">
                          <div class="media-support-user-img mr-3">
                             <img class="rounded-circle img-fluid" src="images/user/1.jpg" alt="">
                          </div>
                          <div class="media-support-info mt-2">
                             <h5 class="mb-0 d-inline-block"><a href="#" class="">Bni Cyst</a></h5>
                             <p class="ml-1 mb-0 d-inline-block">Changed Profile Picture</p>
                             <p class="mb-0">3 day ago</p>
                          </div>
                          <div class="iq-card-post-toolbar">
                             <div class="dropdown">
                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <i class="ri-more-fill"></i>
                                </span>
                                <div class="dropdown-menu m-0 p-0">
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Save Post</h6>
                                            <p class="mb-0">Add this to your saved items</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Hide Post</h6>
                                            <p class="mb-0">See fewer posts like this.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Unfollow User</h6>
                                            <p class="mb-0">Stop seeing posts but stay friends.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Notifications</h6>
                                            <p class="mb-0">Turn on notifications for this post</p>
                                         </div>
                                      </div>
                                   </a>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="user-post text-center">
                       <a href="javascript:void();"><img src="images/page-img/p5.jpg" alt="post-image" class="img-fluid rounded w-100 mt-3"></a>
                    </div>
                    <div class="comment-area mt-3">
                       <div class="d-flex justify-content-between align-items-center">
                          <div class="like-block position-relative d-flex align-items-center">
                             <div class="d-flex align-items-center">
                                <div class="like-data">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      <img src="images/icon/01.png" class="img-fluid" alt="">
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                      </div>
                                   </div>
                                </div>
                                <div class="total-like-block ml-2 mr-3">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      140 Likes
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="dropdown-item" href="#">Max Emum</a>
                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                         <a class="dropdown-item" href="#">Other</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="total-comment-block">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   20 Comment
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Max Emum</a>
                                      <a class="dropdown-item" href="#">Bill Yerds</a>
                                      <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                      <a class="dropdown-item" href="#">Tara Misu</a>
                                      <a class="dropdown-item" href="#">Midge Itz</a>
                                      <a class="dropdown-item" href="#">Sal Vidge</a>
                                      <a class="dropdown-item" href="#">Other</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="share-block d-flex align-items-center feather-icon mr-3">
                             <a href="javascript:void();"><i class="ri-share-line"></i>
                             <span class="ml-1">99 Share</span></a>
                          </div>
                       </div>
                       <hr>
                       <ul class="post-comments p-0 m-0">
                          <li class="mb-2">
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Monty Carlo</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                          <li>
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Paul Molive</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                       </ul>
                       <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                          <input type="text" class="form-control rounded">
                          <div class="comment-attagement d-flex">
                             <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>
        </div>
        <div class="col-sm-12">
              <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                 <div class="iq-card-body">
                    <div class="user-post-data">
                       <div class="d-flex flex-wrap">
                          <div class="media-support-user-img mr-3">
                             <img class="rounded-circle img-fluid" src="images/user/02.jpg" alt="">
                          </div>
                          <div class="media-support-info mt-2">
                             <h5 class="mb-0 d-inline-block"><a href="#" class="">Paige Turner</a></h5>
                             <p class="mb-0 d-inline-block">Added New Video in his Timeline</p>
                             <p class="mb-0 text-primary">1 day ago</p>
                          </div>
                          <div class="iq-card-post-toolbar">
                             <div class="dropdown">
                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <i class="ri-more-fill"></i>
                                </span>
                                <div class="dropdown-menu m-0 p-0">
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Save Post</h6>
                                            <p class="mb-0">Add this to your saved items</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Hide Post</h6>
                                            <p class="mb-0">See fewer posts like this.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Unfollow User</h6>
                                            <p class="mb-0">Stop seeing posts but stay friends.</p>
                                         </div>
                                      </div>
                                   </a>
                                   <a class="dropdown-item p-3" href="#">
                                      <div class="d-flex align-items-top">
                                         <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                         <div class="data ml-2">
                                            <h6>Notifications</h6>
                                            <p class="mb-0">Turn on notifications for this post</p>
                                         </div>
                                      </div>
                                   </a>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="mt-3">
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                    </div>
                    <div class="user-post">
                       <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/j_GsIanLxZk?rel=0" allowfullscreen></iframe>
                       </div>
                    </div>
                    <div class="comment-area mt-3">
                       <div class="d-flex justify-content-between align-items-center">
                          <div class="like-block position-relative d-flex align-items-center">
                             <div class="d-flex align-items-center">
                                <div class="like-data">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      <img src="images/icon/01.png" class="img-fluid" alt="">
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="ml-2 mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like"><img src="images/icon/01.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Love"><img src="images/icon/02.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Happy"><img src="images/icon/03.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="HaHa"><img src="images/icon/04.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Think"><img src="images/icon/05.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sade"><img src="images/icon/06.png" class="img-fluid" alt=""></a>
                                         <a class="mr-2" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lovely"><img src="images/icon/07.png" class="img-fluid" alt=""></a>
                                      </div>
                                   </div>
                                </div>
                                <div class="total-like-block ml-2 mr-3">
                                   <div class="dropdown">
                                      <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                      140 Likes
                                      </span>
                                      <div class="dropdown-menu">
                                         <a class="dropdown-item" href="#">Max Emum</a>
                                         <a class="dropdown-item" href="#">Bill Yerds</a>
                                         <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                         <a class="dropdown-item" href="#">Tara Misu</a>
                                         <a class="dropdown-item" href="#">Midge Itz</a>
                                         <a class="dropdown-item" href="#">Sal Vidge</a>
                                         <a class="dropdown-item" href="#">Other</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="total-comment-block">
                                <div class="dropdown">
                                   <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                   20 Comment
                                   </span>
                                   <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Max Emum</a>
                                      <a class="dropdown-item" href="#">Bill Yerds</a>
                                      <a class="dropdown-item" href="#">Hap E. Birthday</a>
                                      <a class="dropdown-item" href="#">Tara Misu</a>
                                      <a class="dropdown-item" href="#">Midge Itz</a>
                                      <a class="dropdown-item" href="#">Sal Vidge</a>
                                      <a class="dropdown-item" href="#">Other</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="share-block d-flex align-items-center feather-icon mr-3">
                             <a href="javascript:void();"><i class="ri-share-line"></i>
                             <span class="ml-1">99 Share</span></a>
                          </div>
                       </div>
                       <hr>
                       <ul class="post-comments p-0 m-0">
                          <li class="mb-2">
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/02.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Monty Carlo</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                          <li>
                             <div class="d-flex flex-wrap">
                                <div class="user-img">
                                   <img src="images/user/03.jpg" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                   <h6>Paul Molive</h6>
                                   <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                   <div class="d-flex flex-wrap align-items-center comment-activity">
                                      <a href="javascript:void();">like</a>
                                      <a href="javascript:void();">reply</a>
                                      <a href="javascript:void();">translate</a>
                                      <span> 5 min </span>
                                   </div>
                                </div>
                             </div>
                          </li>
                       </ul>
                       <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">
                          <input type="text" class="form-control rounded">
                          <div class="comment-attagement d-flex">
                             <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>
                             <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>
        </div> -->
    </div>
</template>

<script>

import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';
import { Splide, SplideSlide } from '@splidejs/vue-splide';

export default {
   
   components: {
      Splide,
      SplideSlide,
   },
   data() {
      return {
            options: {
               rewind : true,
               width  : 650,
               height  : 400,
	            cover  : true,
               perPage : 1,
               gap : 0,
               padding : 0,
               type : 'fade',
	            focus  : 2,
            },
            posts: {
               "1": {
                  id: 1,
                  userImg:"images/user/01.jpg",
                  userName:"Anna Sthesia",
                  statu:"Add New Post",
                  time:"Just Now",
                  text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                  postImgs: [
                     {img : "images/page-img/p1.jpg"},
                     {img : "images/page-img/p2.jpg"},
                     {img : "images/page-img/p3.jpg"},
                  ],
                  PostVds: [ ]
               },
               "2": {
                  id: 2,
                  userImg:"images/user/03.jpg",
                  userName:"Barb Ackue",
                  statu:"Added New Image in a Post",
                  time:"1 hour ago",
                  text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                  postImgs: [
                     {img : "images/page-img/p4.jpg"},
                  ],
                  PostVds: [ ]
               },
               "3": {
                  id: 3,
                  userImg:"images/user/04.jpg",
                  userName:"Ira Membrit",
                  statu:"Update her Status",
                  time:"6 hour ago",
                  text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                  postImgs: { },
                  PostVds: [ ]
               },
               "4": {
                  id: 4,
                  userImg:"images/user/01.jpg",
                  userName:"Bni Cyst",
                  statu:"Changed Profile Picture",
                  time:"3 day ago",
                  text:"",
                  postImgs: [
                     {img : "images/page-img/p5.jpg"},
                  ],
                  PostVds: [ ]
               },
               "5": {
                  id: 5,
                  userImg:"images/user/02.jpg",
                  userName:"Paige Turner",
                  statu:"Added New Video in his Timeline",
                  time:"1 day ago",
                  text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
                  postImgs: { },
                  PostVds: [
                     { "vd" : "https://www.youtube.com/embed/j_GsIanLxZk?rel=0"}
                  ],
               },
            },
         }
      }
}
</script>
