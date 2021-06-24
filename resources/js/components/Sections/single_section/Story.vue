<template>
    <div class="iq-card storiesSection">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Stories</h4>
            </div>
        </div>
        <div class="iq-card-body" style=" height: 450px; overflow: auto; ">
            <ul class="media-story m-0 p-0">
                <li class="d-flex flex-column">
                    <div class="d-flex mb-4 align-items-center jus">
                        <i class=" imgStory ri-add-line font-size-18"></i>
                        <div class="stories-data ml-3">
                            <h5>Creat Your Story</h5>
                            <p class="mb-0">time to story</p>
                        </div>
                    </div>
                    <div class="div-add-story d-flex mb-4 align-items-center flex-column justify-content-center" >
                        <div class="align-items-center d-flex justify-content-center " style="cursor: pointer;" @click="text">
                            <i class=" img-add-story ri-add-line font-size-18"></i>
                            <div class="stories-data ml-3">
                                <h5>Creat Your Text Story</h5>
                            </div>
                        </div>
                        <div class="w-100" :class="{ 'div-hide' : showText }">
                            <form
                                class="comment-text d-flex align-items-center mt-3"
                                action="javascript:void(0);"
                            >
                                <div class="wrapper-emoji">
                                    <textarea
                                        class="regular-input"
                                        placeholder="Write a story..."
                                        v-model="StoryText"
                                        maxlength="320"
                                    ></textarea>

                                    <emoji-picker
                                        @emoji="append"
                                        :search="search"
                                        class="iconemoji"
                                    >
                                        <div
                                            class="emoji-invoker"
                                            slot="emoji-invoker"
                                            slot-scope="{ events: { click: clickEvent } }"
                                            @click.stop="clickEvent"
                                        >
                                            <i class="ri-user-smile-line"></i>
                                        </div>
                                        <div slot="emoji-picker" slot-scope="{ emojis, insert }">
                                            <div class="emoji-picker">
                                                <div>
                                                    <div
                                                        v-for="(emojiGroup, category) in emojis"
                                                        :key="category"
                                                    >
                                                        <h5 style="color:white">{{ category }}</h5>
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
                                    <div class="comment-attagement d-flex">
                                        <label style=" cursor: pointer; "
                                            ><i class="ri-send-plane-2-line mr-3"></i
                                        ></label>
                                    </div>
                                </div>
                            </form>
                            <div class="storie-style alert d-flex justify-content-around storie-style" v-if="StoryText">
                                <i class="img-add-story ri-font-color font-size-18" style="line-height: inherit;cursor: pointer;" @click="changeFont"></i>     
                                <i class="img-add-story ri-brush-line font-size-18" style="line-height: inherit;cursor: pointer;" @click="changeColor"></i>     
                            </div>
                        </div>
                        <div class="align-items-center d-flex edit-storie justify-content-center" :style="`background : ${getBackground} ; font-family : ${getFont}`" v-if="StoryText">
                            <span>
                                {{StoryText}}
                            </span>
                        </div>
                    </div>
                    <div class="div-add-story d-flex mb-4 align-items-center flex-column justify-content-center" >
                        <div class="align-items-center d-flex justify-content-center " style="cursor: pointer;" @click="media">
                            <i class=" img-add-story ri-add-line font-size-18"></i>
                            <div class="stories-data ml-3">
                                <h5 >Creat Your Media Story</h5>
                            </div>
                        </div>
                        <div class="mb-3 w-100" :class="{ 'div-hide' : showMedia }">
                            <div>
                                <input
                                    type="file"
                                    @change="addFile"
                                    id="addImg"
                                    accept="image/*"
                                    class="div-hide"
                                />
                                <label class="cursor" for="addImg" style="position: relative;width: 100%;">
                                    <div
                                        id="div-img"
                                        class="iq-bg-primary mt-3 p-2 text-center"
                                    >
                                    <img src="https://img.icons8.com/ultraviolet/40/000000/add-image.png" style="width: 30px;"/>
                                    </div>
                                </label>
                            </div>
                            <div class="storie-style alert d-flex justify-content-around storie-style" v-if="fileUrl">
                                <i class="img-add-story ri-brush-line font-size-18" style="line-height: inherit;cursor: pointer;" @click="changeColor"></i>     
                            </div>
                        </div>
                        <div class="edit-storie" v-if="fileUrl" :style="`background : ${getBackground}`">
                            <img :src="fileUrl" alt="" srcset="" style=" width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    </div>
                </li>
                <li
                    class="d-flex mb-4 align-items-center "
                    :class="{ active: story.isActive }"
                    v-for="story in storys"
                    :key="story.id"
                >
                    <img
                        :src="story.img"
                        alt="story-img"
                        class="rounded-circle img-fluid"
                    />
                    <div class="stories-data ml-3">
                        <h5>{{ story.h5 }}</h5>
                        <p class="mb-0">{{ story.p }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="showStories">
            <div class="stories"></div>
        </div>
    </div>
</template>

<script>
import EmojiPicker from "vue-emoji-picker";
export default {
    components: {
        EmojiPicker
    },
    data() {
        return {
            storys: {
                "1": {
                    id: 1,
                    isActive: true,
                    img: "images/page-img/s2.jpg",
                    h5: "Anna Mull",
                    p: "1 hour ago"
                },
                "2": {
                    id: 2,
                    isActive: false,
                    img: "images/page-img/s3.jpg",
                    h5: "Ira Membrit",
                    p: "4 hour ago"
                },
                "3": {
                    id: 3,
                    isActive: false,
                    img: "images/page-img/s1.jpg",
                    h5: "Bob Frapples",
                    p: "9 hour ago"
                }
            },
            font:['remixicon' , 'cursive' , 'fantasy' , 'inherit' , 'monospace' , 'Montserrat'],
            color:['#e76f51' , '#e9c46a' , '#2a9d8f' , '#264653' , '#99d98c', 'var(--iq-dark-box)'],
            getBackground: 'var(--iq-dark-box)',
            getFont: 'Montserrat',
            indexColor: 0,
            indexFont: 0,
            search: "",
            StoryText: "",
            showText: true,
            showMedia: true,
            file: null,
            fileUrl: null,
        };
    },
    methods: {
        append(emoji) {
            if(this.StoryText.length <= 320){
                this.StoryText += emoji;
            }
        },
        reinitialiser(){
            this.getBackground = 'var(--iq-dark-box)'
            this.getFont = 'Montserrat'
            this.file= null
            this.fileUrl = null
            this.StoryText= ""
        },
        text(){
            this.showText = !this.showText;
            this.showMedia = true
            this.reinitialiser()
        },
        media(){
            this.showMedia = !this.showMedia;
            this.showText = true
            this.reinitialiser()
        },
        changeColor(){
            this.getBackground = this.color[this.indexColor];
            this.indexColor < 5 ? this.indexColor++ : this.indexColor = 0;
        },
        changeFont(){
            this.getFont = this.font[this.indexFont];
            this.indexFont < 5 ? this.indexFont++ : this.indexFont = 0;
        },
        addFile(e) {
            this.file = e.target.files[0];
            this.fileUrl = URL.createObjectURL(this.file);
        },
    },
    directives: {
        focus: {
            inserted(el) {
                el.focus();
            }
        }
    }
};
</script>

<style scoped>
.showStories {
    position: fixed;
    width: 100%;
    top: 0px;
    left: 0px;
    height: 100%;
    background: #00000078;
    display: none;
    justify-content: center;
}
.stories {
    position: absolute;
    height: 75vh;
    top: 15%;
    background: aliceblue;
    width: 25%;
}
.addstorie {
    position: relative;
    width: 100px;
    height: 10px;
    background: aliceblue;
}
.edit-storie{
    position: relative;
    width: 80%;
    margin: auto;
    margin-bottom: 20px;
    height: 20rem;
    color: var(--iq-light);
    text-align: center;
    border: double;
    word-break: break-all;
    padding: 10px;
}
.img-add-story{
    height: 40px;
    width: 40px;
    line-height: 60px;
    text-align: center;
    border: 2px solid var(--iq-border-dark);
    padding: 2px;
    border-radius: 50%;
}
.img-add-story:before {
    top: -14px !important;
}
.div-add-story {
    padding: 12px;
    border: 1px dotted;
    border-radius: 10px;
}
.wrapper-emoji {
    width: 100%;
    justify-content: flex-start;
}
.regular-input {
    height: 50px;
    padding: 0rem 1rem;
}
.emoji-invoker {
    top: 0.3rem;
}
.iconemoji {
    position: relative;
    width: 70px;
}
.div-hide{
    display: none;
}
.storie-style{
    position: relative;
    width: 100%;
    height: 60px;
}
</style>
