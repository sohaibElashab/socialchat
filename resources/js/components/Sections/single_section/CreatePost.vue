<template>

   <div id="post-modal-data" class="iq-card iq-card-block iq-card-stretch" v-if="user">
      <div class="iq-card-header d-flex justify-content-between">
         <div class="iq-header-title">
            <h4 class="card-title">Create Post</h4>
         </div>
      </div>
      <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
         <div class="d-flex align-items-center">
            <div class="user-img" >
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
            <li class="iq-bg-primary rounded p-2 pointer mr-3"><a href="#"></a><img src="https://img.icons8.com/dusk/64/000000/like.png"  style="width: 24px;" alt="icon" class="img-fluid"> Feeling</li>
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
                  <div v-if="postImgs.length > 0">
                     <div class="d-flex flex-column bd-highlight">
                        <div class="bd-highlight justify-content-center mt-2">
                           <div class="add-images" v-for="(imgs , index) in postImgs" :key="index" >
                              <button class="delete-btn" >
                                 <i class="ri-delete-bin-line" @click="removeFile(imgs.img)"></i>
                              </button>
                              <a href="javascript:void();" >
                                 <img :src="imgs.img" alt="post-image" class="img-add rounded">
                              </a>
                           </div>
                        </div>
                     </div> 
                     <hr>
                  </div> 
                  <div v-if="postVds.length > 0">
                     <div class="d-flex flex-column bd-highlight">
                        <div class="bd-highlight justify-content-center mt-2">
                           <div class="embed-responsive embed-responsive-16by9 add-video" v-for="(vds , index) in postVds" :key="index">
                              <button class="delete-btn vd-btn" >
                                 <i class="ri-delete-bin-line" @click="removeFile(vds.vd)"></i>
                              </button>
                              <video controls >
                                 <source :src="vds.vd" type="video/mp4">
                                 <source :src="vds.vd" type="video/webm">
                                 <p>Votre navigateur ne prend pas en charge les vidéos HTML5.
                                    Voici <a :href="vds.vd">un lien pour télécharger la vidéo</a>.</p>
                              </video>
                           </div>
                        </div>
                     </div> 
                     <hr>
                  </div> 
                  <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                     <li class="col-md-12 mb-3">
                        <input type="file" name="addImg" id="addImg" @change="addImages" multiple accept="image/*" class="d-none" >
                        <label for="addImg" style="position: relative;width: 100%;">
                           <div id="div-img" class="iq-bg-primary rounded p-2 pointer mr-3">
                                 <img src="images/small/07.png" alt="icon" class="img-fluid"> 
                                 Photo
                           </div>
                        </label>
                     </li>
                     <li class="col-md-12 mb-3">
                        <input type="file" name="addvd" id="addvd" @change="addVd" accept="video/*" class="d-none" >
                        <label for="addvd" style="position: relative;width: 100%;">
                           <div id="div-vd" class="iq-bg-primary rounded p-2 pointer mr-3">
                                 <img src="images/small/08.png" alt="icon" class="img-fluid"> 
                                 Video
                           </div>
                        </label>
                     </li>
                     <li class="col-md-12 mb-3">
                        <div class="iq-bg-primary rounded p-2 pointer mr-3" v-on:click="showFeelings()">
                           <img src="https://img.icons8.com/dusk/64/000000/like.png"  style="width: 24px;" alt="icon" class="img-fluid"> 
                           Feeling
                        </div>
                        <div class="collapse" :class="{ show: showFeeling }">
                           <div class="feelings">
                              <div class="feeling" v-for="(feeling,index) in feelings" :key="index">
                                 <div class="feelImg">
                                    <img :src="feeling.FeelImg" alt="feeling icon" style="width: 60%;">
                                 </div>
                                 <div class="feelSpan">
                                    <span> 
                                       {{feeling.FeelTitle}}
                                    </span>
                                 </div>
                              </div>
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
         user:null,
         myText: "",
         showFeeling: false,
         feelings: {
            "0" : {
               FeelImg: "https://img.icons8.com/color/48/000000/happy--v1.png",
               FeelTitle: "Happy",
            },
            "1" : {
               FeelImg: "https://img.icons8.com/fluent/48/000000/sad.png",
               FeelTitle: "Sad",
            },
            "2" : {
               FeelImg: "https://img.icons8.com/color/64/000000/in-love--v1.png",
               FeelTitle: "Loved",
            },
            "3" : {
               FeelImg: "https://img.icons8.com/color/48/000000/angry.png",
               FeelTitle: "Angry",
            },
            "4" : {
               FeelImg: "https://img.icons8.com/fluent/48/000000/crazy.png",
               FeelTitle: "Crazy",
            },
            "5" : {
               FeelImg: "https://img.icons8.com/emoji/48/000000/drooling-face-emoji.png",
               FeelTitle: "Hungry",
            },
            "6" : {
               FeelImg: "https://img.icons8.com/emoji/48/000000/sleeping-face.png",
               FeelTitle: "Sleepy",
            },
            "7" : {
               FeelImg: "https://img.icons8.com/color/48/000000/bored.png",
               FeelTitle: "Bored",
            },
         },
         postImgs: [],
         postVds: []
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
      showFeelings() {
         this.showFeeling = !this.showFeeling;
      },
      removeFile(path) {
         console.log("removeFile")
         if(this.postImgs.length > 0){
            console.log("removeFile if")
            var newPostImgs = []
            for (let index = 0; index < this.postImgs.length; index++) {
               if(this.postImgs[index].img != path){
                  newPostImgs.push({ img : this.postImgs[index].img})
               }
            }
            this.postImgs = newPostImgs
         }else{
            console.log("removeFile else")
            var newPostVds = []
            for (let index = 0; index < this.postVds.length; index++) {
               if(this.postVds[index].vd != path){
                  newPostVds.push({ vd : this.postVds[index].img})
               }
            }
            this.postVds = newPostVds
         }
         this.disabled();
      },
      addImages(e){
         const file = e.target.files[0];
         var NewImage = URL.createObjectURL(file);
         this.postImgs.push({ img : NewImage });
         this.disabled();
      },
      addVd(e){
         const file = e.target.files[0];
         var NewVd = URL.createObjectURL(file);
         this.postVds.push({ vd : NewVd });
         this.disabled();
      },
      disabled(){
         if(this.postImgs.length > 0 ){
            	document.getElementById("addvd").setAttribute('disabled','disabled');
            	document.getElementById("div-vd").classList.add('classDisabled');

         }else if(this.postVds.length > 0){
            	document.getElementById("addImg").setAttribute('disabled','disabled');
            	document.getElementById("div-img").classList.add('classDisabled');
         }else{
            	document.getElementById("addImg").removeAttribute('disabled');
            	document.getElementById("addvd").removeAttribute('disabled');
            	document.getElementById("div-img").classList.remove('classDisabled');
            	document.getElementById("div-vd").classList.remove('classDisabled');
         }

         if (this.postVds.length == 1){
            	document.getElementById("addvd").setAttribute('disabled','disabled');
            	document.getElementById("div-vd").classList.add('classDisabled');
         }
      }
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

<style scoped>
.feelings{
   position: relative;
   width: 97%;
   border: 1px solid var(--primary);
   border-radius: 10px;
   margin-top: 10px;
   display: flex;
   flex-wrap: wrap;
   justify-content: center;
}
.feeling{
   position: relative;
   width: 48%;
   height: 45px;
   margin: 5px;
   border-radius: 10px;
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: center;
}
.feeling:hover{
   background: rgba(128, 128, 128, 0.171);
}
.feelImg{
   position: relative;
   width: 20%;
   text-align: center;
}
.feelSpan{
   position: relative;
   
   width: 60%;
   text-align: center;
}
.img-add { 
   width: 100%;
   height: 100%;
   position: relative;
   top: -25px;
}
.delete-btn { 
   position: relative;
   top: 5px;
   left: 150px;
   background: var(--iq-white);
   height: 25px;
   width: 25px;
   text-align: center;
   border: none;
   border-radius: 5px;
   opacity: 0;
   z-index: 1;
}
.add-images:hover .delete-btn ,
.add-video:hover .delete-btn { 
   opacity: 1; 
   transition: all 0.45s ease 0s; 
}
.delete-btn > i { 
   color: var(--iq-primary);
}
.vd-btn{
   position: absolute;
    left: 90%
}
.add-images { 
   width: 180px;
   height: 180px;
   margin: 10px;
   float: left;
}
.classDisabled{
   color: grey !important
}
</style>