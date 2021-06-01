<template>
   <div class="iq-card iq-card-block iq-card-stretch" v-if="post">
      <div class="iq-card-body" >
         <div class="user-post-data">
            <div class="d-flex flex-wrap">
               <div class="media-support-user-img mr-3" >
                  <img class="rounded-circle img-fluid"  :src="`images/user/${post.userImg}`" alt="">
               </div>
               <div class="media-support-info mt-2">
                  <h5 class="mb-0 d-inline-block"><a href="#" class="">{{post.userName}}</a></h5>
                  <p class="mb-0 d-inline-block">{{post.statu}}</p>
                  <p class="mb-0 text-primary">{{post.time}}</p>
               </div>
               <div class="iq-card-post-toolbar">
                  <span class="dropdown-toggle" v-if="post.edit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                     <i class=" ri-edit-2-line"></i>
                  </span>
               </div>
            </div>
         </div>
         <div class="mt-3" v-if="post.text">
            <p>{{post.text}}</p>
         </div>
         <div class="user-post" v-if="post.postImgs" style="text-align: -webkit-center;">
            <div v-if="Object.keys(post.postImgs).length > 1" >
               <splide :options="options">
                  <splide-slide v-for="(imgs , index) in post.postImgs" :key="index" style="border-radius: 5px;">
                     <img :src="`images/posts/${post.user_id}/${imgs}`">
                  </splide-slide>
               </splide>
            </div>
            <div v-else class="user-post text-center">
               <a href="javascript:void();" v-for="imgs in post.postImgs" :key="imgs" ><img :src="imgs.img" alt="post-image" class="img-fluid rounded w-100"></a>
            </div>
         </div>
         <!-- <div class="user-post" v-if="Object.keys(post.postVds).length > 0">
            <div class="embed-responsive embed-responsive-16by9">
               <video controls v-for="vds in post.postVds" :key="vds.vd">
                  <source :src="vds.vd" type="video/mp4">
                  <source :src="vds.vd" type="video/webm">
                  <p>Votre navigateur ne prend pas en charge les vidéos HTML5.
                     Voici <a :href="vds.vd">un lien pour télécharger la vidéo</a>.</p>
               </video>
            </div>
         </div> -->
         <Comment/>
      </div>
   </div>
</template>

<script>

import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import Comment from './Comment'

export default {
   
   components: {
      Splide,
      SplideSlide,
      Comment
   },
   props: {
      post: {
         type: Object,
         require: true
      }
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
         }
      },
}
</script>
