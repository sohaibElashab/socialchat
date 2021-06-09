<template>
    <div class="container mt-5 pt-5" >
        <Post
            v-for="(post , index) in posts"
            :key="index"
            :post="post"
        />
    </div>
</template>

<script>
import Post from "../../single_section/Post";
export default {
    components:{Post},
    data() {
        return {
            posts:null
        };
    },
    mounted() {
        axios.get("/posts-saved")
            .then(res => {
                console.log("this.posts");
                this.posts = res.data;
                console.log(res.data);
        });
    },
    methods: {
        acceptFiles() {
            console.log("accepte file");
            if (this.post.postImgs.length > 0 || this.NewImgs.length > 0) {
                this.accept = "image/*";
                console.log("accepte image");
            } else if (this.post.postVds != "") {
                this.accept = "video/*";
                console.log("accepte video");
            } else {
                this.accept = "image/*|video/*";
                console.log("accepte video et image");
            }
        },
        removeImage(path, list) {
            console.log(path);
            var newPostImgs = [];
            var newFilesImgs = [];
            if (list == "old") {
                for (
                    let index = 0;
                    index < this.post.postImgs.length;
                    index++
                ) {
                    if (this.post.postImgs[index] != path) {
                        newPostImgs.push(this.post.postImgs[index]);
                    }
                }
                this.post.postImgs = newPostImgs;
            } else {
                for (let index = 0; index < this.NewImgs.length; index++) {
                    if (this.NewImgs[index] != path) {
                        newPostImgs.push(this.NewImgs[index]);
                        newFilesImgs.push(this.NewFiles[index]);
                    }
                }
                this.NewImgs = newPostImgs;
                this.NewFiles = newFilesImgs;
            }
            this.testFiles(
                this.post.postImgs,
                this.NewImgs,
                this.NewVd,
                this.post.postVds
            );
            this.acceptFiles();
        },
        removeVideo() {
            this.NewFiles = [];
            this.NewVd = "";
            this.post.postVds = "";
            this.testFiles(
                this.post.postImgs,
                this.NewImgs,
                this.NewVd,
                this.post.postVds
            );
            this.acceptFiles();
        },
        addImages(e) {
            const file = e.target.files[0];
            console.log();
            var NewLink = URL.createObjectURL(file);
            if (file.type.substring(0, 5) == "image") {
                this.NewImgs.push(NewLink);
                this.testFiles(
                    this.post.postImgs,
                    this.NewImgs,
                    this.NewVd,
                    this.post.postVds
                );
            } else {
                this.NewFiles = [];
                this.post.postVds = "";
                this.NewVd = NewLink;
                this.testFiles(
                    this.post.postImgs,
                    this.NewImgs,
                    this.NewVd,
                    this.post.postVds
                );
            }
            this.NewFiles.push(file);
            this.acceptFiles();
            document.getElementById("fileForm").reset();
        },
        SelectFeeling(index) {
            var bl = false;
            this.feelings.forEach(element => {
                if (element == this.feelings[index]) {
                    if (this.feelings[index].active == "") {
                        bl = true;
                    } else {
                        bl = false;
                    }
                } else {
                    element.active = "";
                    this.post.statu = "";
                }
            });
            if (bl) {
                this.post.statu =
                    "is feeling " + this.feelings[index].FeelTitle;
                this.feelings[index].active = "classActive";
            } else {
                this.post.statu = "";
                this.feelings[index].active = "";
            }
        },
        testFiles(listImgOld, listImgNew, Oldvideo, Newvideo) {
            if (
                listImgOld.length == 0 &&
                listImgNew.length == 0 &&
                Oldvideo == "" &&
                Newvideo == ""
            ) {
                this.typeFiles = "";
            } else if (Oldvideo != "" || Newvideo != "") {
                this.typeFiles = "video";
            } else {
                this.typeFiles = "images";
            }
        },
        UpdatePost() {
            if (
                this.text == "" &&
                this.post.statu == "" &&
                !this.NewFiles.length &&
                !this.post.postImgs &&
                this.post.postVds == ""
            ) {
                document.getElementById("warning").style.display = "block";
            } else {
                // console.log(this.NewFiles);
                let data = new FormData();
                data.append("id", this.post.id);
                data.append("Statu", this.post.statu);
                data.append("Text", this.text);
                // data.append("images", this.post.postImgs);
                data.append("video", this.post.postVds);

                for (let i = 0; i < this.post.postImgs.length; i++) {
                    let file = this.post.postImgs[i];
                    data.append("image[" + i + "]", file);
                }
                data.append("imgLength", this.post.postImgs.length);

                for (let i = 0; i < this.NewFiles.length; i++) {
                    let file = this.NewFiles[i];
                    data.append("OurFile[" + i + "]", file);
                }

                data.append("fileLength", this.NewFiles.length);
                data.append("fileType", this.typeFiles);

                
                axios
                    .post("/update-post", data)
                    .then(res => {
                        console.log(res.data);
                        this.$router.push({ name: "post" ,query: {postId:res.data}});
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        CancelPost(){
            this.$router.push({ name: "home" });
        },
        deletePost(){
                axios
                    .post("/delete-post", {id : this.post.id})
                    .then(res => {
                        console.log(res.data);
                        this.$router.push({ name: "home" });
                    })
                    .catch(err => {
                        console.log(err);
                    });
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
.delete-btn {
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
.delete:hover .delete-btn {
    opacity: 1;
    transition: all 0.45s ease 0s;
}
.delete-btn > i {
    color: var(--iq-primary);
    position: relative;
    top: -2px;
}
.delete-images {
    width: 250px;
    height: 250px;
    margin: 20px;
    float: left;
}
.d-video {
    position: relative;
    top: -500px;
    left: 95%;
    background: var(--iq-dark-bg);
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
.labelfile {
    padding: 30% 30%;
}
.inputfile,
.labelfile {
    max-width: 1000%;
    font-size: 1.15rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
}

.inputfile,
.labelfile svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}

.inputfile,
.labelfile {
    color: var(--iq-primary);
}

.inputfile:focus .labelfile,
.inputfile.has-focus .labelfile,
.inputfile .labelfile:hover {
    color: var(--iq-light);
}

.inputfile,
.labelfile figure {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: var(--iq-primary);
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile:focus,
.labelfile figure,
.inputfile.has-focus,
.labelfile figure,
.inputfile,
.labelfile:hover figure {
    background-color: var(--iq-light);
}

.inputfile,
.labelfile svg {
    width: 100%;
    height: 100%;
    fill: var(--iq-dark-bg);
}
.box {
    position: relative;
    height: 100%;
    border: 1px dashed var(--iq-primary);
    border-radius: 5px;
    width: 100%;
}
</style>
