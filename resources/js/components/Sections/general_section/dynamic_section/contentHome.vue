<template>
   <div id="content-page" class="content-page">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 row m-0 p-0">
               <CreatePost/>
               <Post v-for="post in posts" :key="post.id" :post="post"/>
            </div>
            <div class="col-lg-4">
               <story/>
            </div>
            <div class="col-sm-12 text-center">
               <img src="images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import story from '../../single_section/Story'
import CreatePost from '../../single_section/CreatePost'
import Post from '../../single_section/Post'
export default {
   components: {
      story,
      CreatePost,
      Post
   },
   data() {
      return {
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
               postVds: [ ]
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
               postVds: [ ]
            },
            "3": {
               id: 3,
               userImg:"images/user/04.jpg",
               userName:"Ira Membrit",
               statu:"Update her Status",
               time:"6 hour ago",
               text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
               postImgs: { },
               postVds: [ ]
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
               postVds: [ ]
            },
            "5": {
               id: 5,
               userImg:"images/user/02.jpg",
               userName:"Paige Turner",
               statu:"Added New Video in his Timeline",
               time:"1 day ago",
               text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
               postImgs: { },
               postVds: [
                  { "vd" : "images/page-img/vd.mp4"}
               ],
            },
         },
      }
   }
}
</script>