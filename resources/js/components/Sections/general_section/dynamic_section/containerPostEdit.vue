<template>
    <div class="container mt-5 pt-5" v-if="post">
        <div class="iq-card iq-card-block iq-card-stretch">
           <div class="iq-card-body" >
              <div class="user-post-data">
                 <div class="d-flex flex-wrap">
                    <div class="media-support-user-img mr-3">
                       <img class="rounded-circle img-fluid" v-if="post.userImg"  :src="`images/user/${post.userImg}`" alt="">
                    </div>
                    <div class="media-support-info mt-2">
                       <h5 class="mb-0 d-inline-block"><a href="#" v-if="post.userName" >{{post.userName}}</a></h5>
                       <p class="mb-0 d-inline-block" v-if="post.statu" >{{post.statu}}</p>
                       <p class="mb-0 text-primary" v-if="post.time" >{{post.time}}</p>
                    </div>
                 </div>
              </div>
              <div class="mt-3" v-if="post.text">
                 <textarea name="" class="form-control" :value="post.text" id=""></textarea>
              </div>
              <div class="user-post" style="text-align: -webkit-center;">
                 <div class="user-post text-center">
                    <div v-if="post.postImgs" >
                        <div class="edit-images" v-for="(imgs , index) in post.postImgs" :key="index" >
                            <button class="edit-btn" >
                                <i class="ri-delete-bin-line" @click="removeImage(imgs , 'old')"></i>
                            </button>
                            <a href="javascript:void();" >
                                <img :src="`images/posts/${post.user_id}/${imgs}`" alt="post-image" class="img-edit rounded">
                            </a>
                        </div>
                    </div>
                    <div v-if="NewImgs" >
                        <div class="edit-images" v-for="(img , index) in NewImgs" :key="index" >
                            <button class="edit-btn" >
                                <i class="ri-delete-bin-line" @click="removeImage(img , 'new')"></i>
                            </button>
                            <a href="javascript:void();" >
                                <img :src="`${img}`" alt="post-image" class="img-edit rounded">
                            </a>
                        </div>
                    </div>
                    <div class="edit-images">
                        <div class="box">
				        	<input type="file" name="file" id="file" @change="addImages" class="inputfile" :accept="accept" multiple="">
				        	<label for="file">
                                <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                    </svg>
                                </figure>
                                <span>Add another picture ...</span>
                            </label>
				        </div>
                    </div>
                 </div>
              </div>
              <div class="user-post" v-if="post.postVds">
                 <div class="embed-responsive embed-responsive-16by9">
                    <video controls >
                       <source :src="`videos/posts/${post.user_id}/${post.postVds}`" type="video/mp4">
                       <source :src="`videos/posts/${post.user_id}/${post.postVds}`" type="video/webm">
                       <p>Votre navigateur ne prend pas en charge les vidéos HTML5.
                          Voici <a :href="`videos/posts/${post.user_id}/${post.postVds}`">un lien pour télécharger la vidéo</a>.</p>
                    </video>
                 </div>
              </div>
           </div>
           <div>
            <button type="button" class="btn btn-primary ml-4 mb-4 mt-4">Submit</button>
            <button type="button" class="btn btn-danger ml-4 mb-4 mt-4">Cancel</button>
           </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // post: {
            //     id: 1,
            //     userImg: "images/user/01.jpg",
            //     userName: "Anna Sthesia",
            //     statu: "Add New Post",
            //     time: "Just Now",
            //     text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus",
            //     postImgs: [
            //         { img: "images/page-img/test/p1.jpg" },
            //         { img: "images/page-img/test/p2.jpg" },
            //         { img: "images/page-img/test/p3.jpg" },
            //         { img: "images/page-img/test/p4.jpg" },
            //         { img: "images/page-img/test/p5.jpg" },
            //     ],
            //     postVds: []
            // },
            post: null,
            NewFiles : [],
            NewImgs: [],
            postId : null,
            accept:'',
        };
    },
    mounted(){
        this.postId = this.$route.query.postId;
        axios.post("/GetPost" , { id: this.postId })
            .then(res => {
                console.log("this.post");
                this.post = res.data;
                console.log(res.data);
                console.log(this.post);
        });
        this.acceptFiles()
    },
    methods: {
        acceptFiles(){
            if(this.post.postImgs != [] || this.NewImgs != []){
                this.accept = 'image/*'
            }else if(this.post.video != []){
                this.accept = 'video/*'
            }else{
                this.accept = 'image/*|video/*'
            }
        },
        removeImage(path , list ) {
            console.log(path)
            var newPostImgs = []
            var newFilesImgs = []
            if(list == 'old'){
                for (let index = 0; index < this.post.postImgs.length; index++) {
                    if(this.post.postImgs[index] != path){
                        newPostImgs.push(this.post.postImgs[index])
                    }
                }
                this.post.postImgs = newPostImgs;
            }else{
                for (let index = 0; index < this.NewImgs.length; index++) {
                    if(this.NewImgs[index] != path){
                        newPostImgs.push(this.NewImgs[index])
                        newFilesImgs.push(this.NewFiles[index])
                    }
                }
                this.NewImgs = newPostImgs;
                this.NewFiles = newFilesImgs;
            }
            this.acceptFiles()
        },
        addImages(e){
            const file = e.target.files[0];
            var NewImage = URL.createObjectURL(file);
            this.NewImgs.push(NewImage);
            this.NewFiles.push(e.target.files[0]);
            console.log(e.target.files[0]);
            this.acceptFiles()
        }
    } 
};
</script>

<style scoped>
.img-edit { 
    width: 100%;
    height: 100%;
    position: relative;
    top: -25px;
}
.edit-btn { 
    position: relative;
    top: 5px;
    left: 108px;
    background: var(--iq-white);
    height: 25px;
    width: 25px;
    text-align: center;
    border: none;
    border-radius: 5px;
    opacity: 0;
    z-index: 1;
}
.edit-images:hover .edit-btn { 
    opacity: 1; 
    transition: all 0.45s ease 0s; 
}
.edit-btn > i { 
    color: var(--iq-primary);
}
.edit-images { 
    width: 250px;
    height: 250px;
    margin: 20px;
    float: left;
}



.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    display: none;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.15rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
}

.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}

.inputfile + label {
    color: var(--iq-primary);
}

.inputfile:focus + label,
.inputfile.has-focus + label,
.inputfile + label:hover {
    color: var(--iq-light);
}

.inputfile + label figure {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: var(--iq-primary);
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile:focus + label figure,
.inputfile.has-focus + label figure,
.inputfile + label:hover figure {
    background-color: var(--iq-light);
}

.inputfile + label svg {
    width: 100%;
    height: 100%;
    fill: var(--iq-dark-bg);
}
.box {
    position: relative;
    top: 40px;
}


</style>