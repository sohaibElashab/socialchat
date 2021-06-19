<template>
    <div
        id="post-modal-data"
        class="iq-card iq-card-block iq-card-stretch"
        v-if="user"
    >
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create Post</h4>
            </div>
        </div>
        <div
            class="iq-card-body"
            id="HeadPost"
            style="cursor: pointer;"
            @click="open"
        >
            <div class="d-flex align-items-center">
                <div class="user-img">
                    <img
                        :src="`images/user/${user.profileimg.name}`"
                        alt="userimg"
                        class="avatar-60 rounded-circle"
                    />
                </div>
                <form class="post-text ml-3 w-100" action="javascript:void();">
                    <input
                        type="text"
                        class="form-control rounded"
                        placeholder="Write something here..."
                        style="border:none;"
                    />
                </form>
            </div>
            <hr />
            <ul
                class="post-opt-block d-flex align-items-center list-inline m-0 p-0"
            >
                <li class="iq-bg-primary rounded p-2 pointer mr-3">
                    <a href="#"></a
                    ><img
                        src="images/small/07.png"
                        alt="icon"
                        class="img-fluid"
                    />
                    Photo
                </li>
                <li class="iq-bg-primary rounded p-2 pointer mr-3">
                    <a href="#"></a
                    ><img
                        src="images/small/08.png"
                        alt="icon"
                        class="img-fluid"
                    />
                    Video
                </li>
                <li class="iq-bg-primary rounded p-2 pointer mr-3">
                    <a href="#"></a
                    ><img
                        src="https://img.icons8.com/dusk/64/000000/like.png"
                        style="width: 24px;"
                        alt="icon"
                        class="img-fluid"
                    />
                    Feeling
                </li>
            </ul>
        </div>
        <div id="BodyPost" class="mt-3" style="display : none">
            <div class="d-flex flex-column bd-highlight">
                <div class="bd-highlight mb-2">
                    <div class="d-flex flex-wrap">
                        <div class="media-support-user-img mr-3 ml-3">
                            <img
                                class="rounded-circle img-fluid"
                                :src="`images/user/${user.profileimg.name}`"
                                alt=""
                            />
                        </div>
                        <div class="media-support-info mt-2">
                            <h5 class="mb-0 d-inline-block">{{ user.name }}</h5>
                            <p class="mb-0 text-primary" v-if="UserStatu">
                                {{ UserStatu }}
                            </p>
                        </div>
                        <div class="iq-card-post-toolbar mr-4">
                            <span
                                class="dropdown-toggle"
                                @click="close"
                                role="button"
                            >
                                <i
                                    data-dismiss="modal"
                                    class="ri-close-fill"
                                ></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bd-highlight justify-content-center mt-2">
                    <form class="post-text" action="javascript:void();">
                        <div class="wrapper-emoji">
                            <textarea
                                class="regular-input"
                                :placeholder="`What's on your mind, ${user.name} ?`"
                                v-model="myText"
                            ></textarea>

                            <emoji-picker @emoji="append" :search="search">
                                <div
                                    class="emoji-invoker"
                                    slot="emoji-invoker"
                                    slot-scope="{
                                        events: { click: clickEvent }
                                    }"
                                    @click.stop="clickEvent"
                                >
                                    <i class="ri-user-smile-line"></i>
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
                    </form>
                </div>
            </div>
            <hr />
            <div v-if="postImgs.length > 0">
                <div class="d-flex flex-column bd-highlight">
                    <div class="bd-highlight justify-content-center mt-2">
                        <div
                            class="add-images"
                            v-for="(imgs, index) in postImgs"
                            :key="index"
                        >
                            <button class="delete-btn">
                                <i
                                    class="ri-delete-bin-line"
                                    @click="removeFile(imgs.img)"
                                ></i>
                            </button>
                            <a href="javascript:void();">
                                <img
                                    :src="imgs.img"
                                    alt="post-image"
                                    class="img-add rounded"
                                />
                            </a>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
            <div v-if="postVds">
                <div class="d-flex flex-column bd-highlight">
                    <div class="bd-highlight justify-content-center mt-2">
                        <div
                            class="embed-responsive embed-responsive-16by9 add-video"
                        >
                            <button class="delete-btn vd-btn">
                                <i
                                    class="ri-delete-bin-line"
                                    @click="removeFile(postVds)"
                                ></i>
                            </button>
                            <video controls>
                                <source :src="postVds" type="video/mp4" />
                                <source :src="postVds" type="video/webm" />
                                <p>
                                    Votre navigateur ne prend pas en charge les
                                    vidéos HTML5. Voici
                                    <a :href="postVds"
                                        >un lien pour télécharger la vidéo</a
                                    >.
                                </p>
                            </video>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
            <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                <li class="col-md-12 mb-3">
                    <input
                        type="file"
                        name="addImg"
                        id="addImg"
                        @change="addImages"
                        multiple
                        accept="image/*"
                        class="d-none"
                    />
                    <label for="addImg" style="position: relative;width: 100%;">
                        <div
                            id="div-img"
                            class="iq-bg-primary rounded p-2 pointer mr-3"
                        >
                            <img
                                src="images/small/07.png"
                                alt="icon"
                                class="img-fluid"
                            />
                            Photo
                        </div>
                    </label>
                </li>
                <li class="col-md-12 mb-3">
                    <input
                        type="file"
                        name="addvd"
                        id="addvd"
                        @change="addVd"
                        accept="video/*"
                        class="d-none"
                    />
                    <label for="addvd" style="position: relative;width: 100%;">
                        <div
                            id="div-vd"
                            class="iq-bg-primary rounded p-2 pointer mr-3"
                        >
                            <img
                                src="images/small/08.png"
                                alt="icon"
                                class="img-fluid"
                            />
                            Video
                        </div>
                    </label>
                </li>
                <li class="col-md-12 mb-3">
                    <div
                        class="iq-bg-primary rounded p-2 pointer mr-3"
                        @click="showFeelings()"
                    >
                        <img
                            src="https://img.icons8.com/dusk/64/000000/like.png"
                            style="width: 24px;"
                            alt="icon"
                            class="img-fluid"
                        />
                        Feeling
                    </div>
                    <div class="collapse" :class="{ show: showFeeling }">
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
                </li>
            </ul>
            <button
                @click="createPost()"
                class="btn btn-primary d-block w-100 mt-3"
            >
                Post
            </button>
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
    data() {
        return {
            user: null,
            search: "",
            myText: "",
            UserStatu: "",
            image: null,
            Images: [],
            Videos: null,
            showFeeling: false,
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
            postImgs: [],
            postVds: "",
        };
    },
    methods: {
        append(emoji) {
            this.myText += emoji;
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
                    this.UserStatu = "";
                }
            });

            if (bl) {
                this.UserStatu = "is feeling " + this.feelings[index].FeelTitle;
                this.feelings[index].active = "classActive";
            } else {
                this.UserStatu = "";
                this.feelings[index].active = "";
            }
        },
        clearTextarea() {
            this.$refs.emoji.clear();
        },
        showFeelings() {
            this.showFeeling = !this.showFeeling;
        },
        removeFile(path) {
            //console.log("removeFile");
            if (this.postImgs.length > 0) {
                var newPostImgs = [];
                for (let index = 0; index < this.postImgs.length; index++) {
                    if (this.postImgs[index].img == path) {
                        this.postImgs.splice(index, 1);
                        this.Images.splice(index, 1);
                    }
                }
            } else {
                this.postVds = "";
                this.Videos = null;
            }
            this.disabled();
        },
        addImages(e) {
            const file = e.target.files[0];
            var NewImage = URL.createObjectURL(file);
            this.postImgs.push({ img: NewImage });
            this.image = file;
            this.Images.push(this.image);
            this.disabled();
        },
        addVd(e) {
            const file = e.target.files[0];
            var NewVd = URL.createObjectURL(file);
            this.postVds = NewVd;
            this.Videos = file;
            this.disabled();
        },
        disabled() {
            if (this.postImgs.length > 0) {
                document
                    .getElementById("addvd")
                    .setAttribute("disabled", "disabled");
                document
                    .getElementById("div-vd")
                    .classList.add("classDisabled");
            } else if (this.postVds != "") {
                document
                    .getElementById("addImg")
                    .setAttribute("disabled", "disabled");
                document
                    .getElementById("div-img")
                    .classList.add("classDisabled");
            } else {
                document.getElementById("addImg").removeAttribute("disabled");
                document.getElementById("addvd").removeAttribute("disabled");
                document
                    .getElementById("div-img")
                    .classList.remove("classDisabled");
                document
                    .getElementById("div-vd")
                    .classList.remove("classDisabled");
            }
        },
        createPost() {
            if (
                this.myText == "" &&
                this.UserStatu == "" &&
                !this.Images.length &&
                this.Videos == null
            ) {
                document.getElementById("warning").style.display = "block";
            } else {
                let data = new FormData();
                data.append("Statu", this.UserStatu);
                data.append("Text", this.myText);
                data.append("Video", this.Videos);

                for (let i = 0; i < this.Images.length; i++) {
                    let file = this.Images[i];
                    data.append("Images[" + i + "]", file);
                }

                data.append("imagenbr", this.Images.length);

                axios
                    .post("/create-post", data)
                    .then(res => {
                        // console.log(res);
                        this.myText = "";
                        this.UserStatu = "";
                        this.postImgs = [];
                        this.Images = [];
                        this.Videos = null;
                        this.disabled();
                        this.$emit("newPost", res.data);
                        this.close();

                        // console.log(res.config.data)
                    })
                    .catch(err => {
                        console.log(err);
                    });
                // document.getElementById("post-modal").style.display = 'none';
            }
        },
        open() {
            document.getElementById("HeadPost").style.display = "none";
            document.getElementById("BodyPost").style.display = "block";
        },
        close() {
            document.getElementById("HeadPost").style.display = "block";
            document.getElementById("BodyPost").style.display = "none";
        }
    },
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
    mounted() {
        axios.get("/profile").then(res => {
            this.user = res.data;
        });
    }
};
</script>

<style scoped>
.wrapper-emoji {
    justify-content: center;
}
.regular-input {
    height: 100px;
    padding: 0.25rem 1rem;
}
.emoji-invoker {    
    top: 1.5rem;
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
.add-images:hover .delete-btn,
.add-video:hover .delete-btn {
    opacity: 1;
    transition: all 0.45s ease 0s;
}
.delete-btn > i {
    color: var(--iq-primary);
}
.vd-btn {
    position: absolute;
    left: 90%;
}
.add-images {
    width: 180px;
    height: 180px;
    margin: 10px;
    float: left;
}
.classDisabled {
    color: grey !important;
}
</style>
