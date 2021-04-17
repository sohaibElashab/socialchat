<template>
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
           <div class="iq-header-title">
              <h4 class="card-title">Stories</h4>
           </div>
        </div>
        <div class="iq-card-body">
           <ul class="media-story m-0 p-0">
              <li class="d-flex mb-4 align-items-center">
                 <i class="ri-add-line font-size-18"></i>
                 <div class="stories-data ml-3">
                    <h5>Creat Your Story</h5>
                    <p class="mb-0">time to story</p>
                 </div>
              </li>
              <li class="d-flex mb-4 align-items-center " :class="{ active: story.isActive }" v-for="story in storys" :key="story.id">
                 <img :src="story.img" alt="story-img" class="rounded-circle img-fluid">
                 <div class="stories-data ml-3">
                    <h5>{{story.h5}}</h5>
                    <p class="mb-0">{{story.p}}</p>
                 </div>
              </li>
           </ul>
           <a href="#" class="btn btn-primary d-block mt-3">Show More</a>
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
        storys: {
            "1": {
                id: 1,
                isActive: true,
                img: "images/page-img/s2.jpg",
                h5:"Anna Mull",
                p:"1 hour ago", 
            },
            "2": {
                id: 2,
                isActive: false,
                img: "images/page-img/s3.jpg",
                h5:"Ira Membrit",
                p:"4 hour ago", 
            },
            "3": {
                id: 3,
                isActive: false,
                img: "images/page-img/s1.jpg",
                h5:"Bob Frapples",
                p:"9 hour ago", 
            }
        }
    }
}
}
</script>