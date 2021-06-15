<template>
    <div class="container mt-5 pt-5" v-if="post">
        <div class="iq-card iq-card-block iq-card-stretch">
            <div class="iq-card-body">
                <div class="user-post-data">
                    <div class="d-flex flex-wrap">
                        <div class="media-support-user-img mr-3">
                            <img
                                class="rounded-circle img-fluid"
                                v-if="post.userImg"
                                :src="`images/user/${post.userImg}`"
                                alt=""
                            />
                        </div>
                        <div class="media-support-info mt-2">
                            <h5 class="mb-0 d-inline-block">
                                <a href="#" v-if="post.userName">{{
                                    post.userName
                                }}</a>
                            </h5>
                            <p class="mb-0 d-inline-block" v-if="post.statu">
                                {{ post.statu }}
                            </p>
                            <p class="mb-0 text-primary" v-if="post.time">
                                {{ post.time }}
                            </p>
                        </div>
                        <div class="iq-card-post-toolbar">
                            <span class="dropdown-toggle" role="button">
                                <i
                                    @click="deletePost()"
                                    class="ri-delete-bin-line"
                                ></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-3" v-if="post.text">
                    <!--  <textarea
                        name=""
                        class="form-control"
                        v-model="text"
                        id="textarea"
                    ></textarea> -->

                    <div class="wrapper">
                        <textarea
                            class="form-control"
                            placeholder="Message..."
                            v-model="text"
                            id="textarea"
                        ></textarea>

                        <emoji-picker @emoji="append" :search="search">
                            <div
                                class="emoji-invoker"
                                slot="emoji-invoker"
                                slot-scope="{ events: { click: clickEvent } }"
                                @click.stop="clickEvent"
                            >
                                <svg
                                    height="24"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"
                                    />
                                </svg>
                            </div>
                            <div
                                slot="emoji-picker"
                                slot-scope="{ emojis, insert }"
                            >
                                <div class="emoji-picker">
                                    <div>
                                        <div
                                            v-for="(emojiGroup,
                                            category) in emojis"
                                            :key="category"
                                        >
                                            <h5 style="color:white">
                                                {{ category }}
                                            </h5>
                                            <div class="emojis">
                                                <span
                                                    v-for="(emoji,
                                                    emojiName) in emojiGroup"
                                                    :key="emojiName"
                                                    @click="insert(emoji)"
                                                    :title="emojiName"
                                                    >{{ emoji }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </emoji-picker>
                    </div>

                    <!-- fff -->
                </div>
                <div class="user-post" style="text-align: -webkit-center;">
                    <div class="user-post text-center">
                        <div v-if="post.postImgs.length > 0">
                            <div
                                class="delete-images delete"
                                v-for="(imgs, index) in post.postImgs"
                                :key="index"
                            >
                                <button class="delete-btn">
                                    <i
                                        class="ri-delete-bin-line"
                                        @click="removeImage(imgs, 'old')"
                                    ></i>
                                </button>
                                <a href="javascript:void();">
                                    <img
                                        :src="
                                            `images/posts/${post.user_id}/${imgs}`
                                        "
                                        alt="post-image"
                                        class="img-edit rounded"
                                    />
                                </a>
                            </div>
                        </div>
                        <div v-if="NewImgs.length > 0">
                            <div
                                class="delete-images delete"
                                v-for="(img, index) in NewImgs"
                                :key="index"
                            >
                                <button class="delete-btn">
                                    <i
                                        class="ri-delete-bin-line"
                                        @click="removeImage(img, 'new')"
                                    ></i>
                                </button>
                                <a href="javascript:void();">
                                    <img
                                        :src="`${img}`"
                                        alt="post-image"
                                        class="img-edit rounded"
                                    />
                                </a>
                            </div>
                        </div>
                        <div
                            class="delete-images"
                            v-if="NewVd == '' && post.postVds == ''"
                        >
                            <div class="box">
                                <form id="fileForm">
                                    <input
                                        type="file"
                                        name="file"
                                        id="file"
                                        @change="addImages"
                                        class="inputfile"
                                        :accept="accept"
                                        multiple=""
                                    />
                                </form>
                                <label for="file" class="labelfile">
                                    <figure>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="17"
                                            viewBox="0 0 20 17"
                                        >
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"
                                            ></path>
                                        </svg>
                                    </figure>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-post delete" v-if="post.postVds != ''">
                    <div class="embed-responsive embed-responsive-16by9">
                        <button class="delete-btn d-video">
                            <i
                                class="ri-delete-bin-line"
                                @click="removeVideo()"
                            ></i>
                        </button>
                        <video controls>
                            <source
                                :src="
                                    `videos/posts/${post.user_id}/${post.postVds}`
                                "
                                type="video/mp4"
                            />
                            <source
                                :src="
                                    `videos/posts/${post.user_id}/${post.postVds}`
                                "
                                type="video/webm"
                            />
                            <p>
                                Votre navigateur ne prend pas en charge les
                                vidéos HTML5. Voici
                                <a
                                    :href="
                                        `videos/posts/${post.user_id}/${post.postVds}`
                                    "
                                    >un lien pour télécharger la vidéo</a
                                >.
                            </p>
                        </video>
                    </div>
                </div>
                <div class="user-post delete" v-if="NewVd != ''">
                    <div class="embed-responsive embed-responsive-16by9">
                        <button class="delete-btn d-video">
                            <i
                                class="ri-delete-bin-line"
                                @click="removeVideo()"
                            ></i>
                        </button>
                        <video controls>
                            <source :src="NewVd" type="video/mp4" />
                            <source :src="NewVd" type="video/webm" />
                            <p>
                                Votre navigateur ne prend pas en charge les
                                vidéos HTML5. Voici
                                <a :href="NewVd"
                                    >un lien pour télécharger la vidéo</a
                                >.
                            </p>
                        </video>
                    </div>
                </div>
                <div>
                    <div class="collapse show">
                        <div class="feelings">
                            <div
                                :class="`feeling ${feeling.active}`"
                                v-for="(feeling, index) in feelings"
                                :key="index"
                                @click="SelectFeeling(index)"
                            >
                                <div class="feelImg">
                                    <img
                                        :src="feeling.FeelImg"
                                        alt="feeling icon"
                                        style="width: 60%;"
                                    />
                                </div>
                                <div class="feelSpan">
                                    <span>
                                        {{ feeling.FeelTitle }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button
                    type="button"
                    @click="UpdatePost()"
                    class="btn btn-primary ml-4 mb-4 mt-4"
                >
                    Update
                </button>
                <button
                    @click="CancelPost()"
                    type="button"
                    class="btn btn-danger ml-4 mb-4 mt-4"
                >
                    Cancel
                </button>
            </div>
            <div
                id="warning"
                class="alert alert-warning mt-3"
                style="display:none;"
                role="alert"
            >
                <strong>The post </strong> must conatin a text, photos, video,
                or feelings
            </div>
        </div>
    </div>
</template>

<script>
import EmojiPicker from "vue-emoji-picker";
export default {
    components: {
        EmojiPicker
    },
    directives: {
        focus: {
            inserted(el) {
                el.focus();
            }
        }
    },
    data() {
        return {
            post: null,
            text: "",
            NewFiles: [],
            typeFiles: "",
            NewImgs: [],
            NewVd: "",
            postId: null,
            accept: "",
            feelings: [
                {
                    FeelImg:
                        "https://img.icons8.com/color/48/000000/happy--v1.png",
                    FeelTitle: "Happy",
                    active: ""
                },
                {
                    FeelImg: "https://img.icons8.com/fluent/48/000000/sad.png",
                    FeelTitle: "Sad",
                    active: ""
                },
                {
                    FeelImg:
                        "https://img.icons8.com/color/64/000000/in-love--v1.png",
                    FeelTitle: "Loved",
                    active: ""
                },
                {
                    FeelImg: "https://img.icons8.com/color/48/000000/angry.png",
                    FeelTitle: "Angry",
                    active: ""
                },
                {
                    FeelImg:
                        "https://img.icons8.com/fluent/48/000000/crazy.png",
                    FeelTitle: "Crazy",
                    active: ""
                },
                {
                    FeelImg:
                        "https://img.icons8.com/emoji/48/000000/drooling-face-emoji.png",
                    FeelTitle: "Hungry",
                    active: ""
                },
                {
                    FeelImg:
                        "https://img.icons8.com/emoji/48/000000/sleeping-face.png",
                    FeelTitle: "Sleepy",
                    active: ""
                },
                {
                    FeelImg: "https://img.icons8.com/color/48/000000/bored.png",
                    FeelTitle: "Bored",
                    active: ""
                }
            ],
            search: ""
        };
    },
    mounted() {
        this.postId = this.$route.query.postId;
        axios.post("/GetPost", { id: this.postId }).then(res => {
            console.log("this.post");
            this.post = res.data;
            this.feelings.forEach((element, index) => {
                if (element.FeelTitle == this.post.statu.substring(11)) {
                    this.SelectFeeling(index);
                }
            });
            this.testFiles(
                this.post.postImgs,
                this.NewImgs,
                this.NewVd,
                this.post.postVds
            );
            this.text = this.post.text;
            this.acceptFiles();
            console.log(res.data);
            console.log(this.post);
        });
    },
    methods: {
        append(emoji) {
            this.text += emoji;
        },
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
                        this.$router.push({
                            name: "post",
                            query: { postId: res.data }
                        });
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        CancelPost() {
            this.$router.push({ name: "home" });
        },
        deletePost() {
            axios
                .post("/delete-post", { id: this.post.id })
                .then(res => {
                    console.log(res.data);
                    //this.$router.push({ name: "home" });
                    this.$router.back();
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
/* emojie style */
.wrapper {
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.regular-input {  
    position: relative;
    width: 90% ;  
    height: 100px;
    background: transparent;
    color: var(--iq-dark-body-text);
    border: 1px solid var(--iq-border-dark);
    border-radius: 10px;
    padding: 0.25rem 1rem;
    font-size: 14px;
    line-height: 45px;
    outline: none;
    resize: none;
    overflow: auto;
}

.regular-input:focus {
    border: 1px solid var(--iq-primary-hover);
}

.emoji-invoker {    
    position: absolute;
    top: 2.5rem;
    margin-left: 10px;
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.2s;
}
.emoji-invoker:hover {
    transform: scale(1.1);
}
.emoji-invoker > svg {
    fill: #b1c6d0;
}

.emoji-picker {
    position: absolute;
    top: 4rem;
    right: 0rem;
    border: 1px solid #ccc;
    width: 15rem;
    height: 20rem;
    overflow: auto;
    padding: 1rem;
    border-radius: 1rem;
    background: var(--iq-dark-body-text);
    box-shadow: 1px 2px 5px #c7dbe6;
    z-index: 11;
}
.emoji-picker h5 {
    margin-bottom: 0;
    color: #b1b1b1;
    text-transform: uppercase;
    font-size: 0.8rem;
    cursor: default;
}
.emoji-picker .emojis {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.emoji-picker .emojis:after {
    content: "";
    flex: auto;
}
.emoji-picker .emojis span {
    padding: 0.2rem;
    cursor: pointer;
    border-radius: 5px;
}
.emoji-picker .emojis span:hover {
    background: #ececec;
    cursor: pointer;
}
</style>
