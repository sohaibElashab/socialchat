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
                    <div
                        class="d-flex mb-4 align-items-center jus"
                        @click="addShow"
                        style="cursor: pointer;"
                    >
                        <i class=" imgStory ri-add-line font-size-18"></i>
                        <div class="stories-data ml-3">
                            <h5>Creat Your Story</h5>
                            <p class="mb-0">time to story</p>
                        </div>
                    </div>
                    <div
                        class="div-add-story d-flex mb-3 align-items-center flex-column justify-content-center"
                        :class="{ 'div-hide': showAdd }"
                    >
                        <div
                            class="align-items-center d-flex justify-content-center "
                            style="cursor: pointer;"
                            @click="text"
                        >
                            <i
                                class=" img-add-story ri-add-line font-size-18"
                            ></i>
                            <div class="stories-data ml-3">
                                <h5>Creat Your Text Story</h5>
                            </div>
                        </div>
                        <div class="w-100" :class="{ 'div-hide': showText }">
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
                                                                @click="
                                                                    insert(
                                                                        emoji
                                                                    )
                                                                "
                                                                :title="
                                                                    emojiName
                                                                "
                                                                >{{
                                                                    emoji
                                                                }}</span
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </emoji-picker>
                                    <div
                                        class="comment-attagement d-flex"
                                        v-if="StoryText"
                                        @click="addStories()"
                                    >
                                        <label style=" cursor: pointer; "
                                            ><i
                                                class="ri-send-plane-2-line mr-3"
                                            ></i
                                        ></label>
                                    </div>
                                </div>
                            </form>
                            <div
                                class="storie-style alert d-flex justify-content-around storie-style"
                                v-if="StoryText"
                            >
                                <i
                                    class="img-add-story ri-font-color font-size-18"
                                    style="line-height: inherit;cursor: pointer;"
                                    @click="changeFont"
                                ></i>
                                <i
                                    class="img-add-story ri-brush-line font-size-18"
                                    style="line-height: inherit;cursor: pointer;"
                                    @click="changeColor"
                                ></i>
                            </div>
                        </div>
                        <div
                            class="align-items-center d-flex edit-storie justify-content-center"
                            :style="
                                `${getBackground} ; font-family : ${getFont}`
                            "
                            v-if="StoryText"
                        >
                            <span>
                                {{ StoryText }}
                            </span>
                        </div>
                    </div>
                    <div
                        class="div-add-story d-flex mb-3 align-items-center flex-column justify-content-center"
                        :class="{ 'div-hide': showAdd }"
                    >
                        <div
                            class="align-items-center d-flex justify-content-center "
                            style="cursor: pointer;"
                            @click="media"
                        >
                            <i
                                class=" img-add-story ri-add-line font-size-18"
                            ></i>
                            <div class="stories-data ml-3">
                                <h5>Creat Your Media Story</h5>
                            </div>
                        </div>
                        <div
                            class="mb-3 w-100"
                            :class="{ 'div-hide': showMedia }"
                        >
                            <div class="align-items-baseline d-flex">
                                <label
                                    style="position: relative;width: 100%;"
                                    @click="testClick"
                                >
                                    <div
                                        id="div-img"
                                        class="mt-3 p-2 text-center"
                                    >
                                        <img
                                            src="https://img.icons8.com/material-outlined/24/4a90e2/add-image.png"
                                        />
                                    </div>
                                </label>
                                <input
                                    type="file"
                                    @change="addFile"
                                    accept="image/*"
                                    id="addImg"
                                    ref="imagePicker"
                                    class="div-hide"
                                /><!--   -->
                                <div
                                    class="comment-attagement d-flex"
                                    style="position: relative;"
                                    v-if="fileUrl"
                                    @click="addStories()"
                                >
                                    <label style=" cursor: pointer; "
                                        ><i
                                            class="ri-send-plane-2-line mr-3"
                                        ></i
                                    ></label>
                                </div>
                            </div>
                            <div
                                class="storie-style alert d-flex justify-content-around storie-style"
                                v-if="fileUrl"
                            >
                                <i
                                    class="img-add-story ri-brush-line font-size-18"
                                    style="line-height: inherit;cursor: pointer;"
                                    @click="changeColor"
                                ></i>
                            </div>
                        </div>
                        <div
                            class="edit-storie"
                            v-if="fileUrl"
                            :style="`${getBackground}`"
                        >
                            <img
                                :src="fileUrl"
                                alt=""
                                srcset=""
                                style=" width: 100%; height: 100%; object-fit: contain;"
                            />
                        </div>
                    </div>
                </li>
                <li
                    class="d-flex mb-4 align-items-center "
                    :class="{ active: story.isActive }"
                    v-for="story in storys"
                    :key="story.id"
                    style="cursor:pointer"
                    @click="ShowStory(story)"
                >
                    <img
                        :src="`images/user/${story.img.name}`"
                        alt="story-img"
                        class="rounded-circle img-fluid"
                    />
                    <div class="stories-data ml-3">
                        <h5>{{ story.name }}</h5>
                        <p class="mb-0">{{ story.time }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="showStories" id="showStories" style="display:none">
            <div class="fake" @click="close"></div>
            <i
                class="ri-arrow-left-s-line"
                id="prevBTN"
                v-if="current_story > 0"
                @click="previousOne"
            ></i>
            <div class="stories" id="stories">
                <nav
                    class="nav"
                    :style="
                        `grid-template-columns: repeat(${colors.length}, 1fr)`
                    "
                >
                    <div
                        class="parent"
                        v-for="(color, index) in colors"
                        :key="index"
                    >
                        <div :id="`id${index}`"></div>
                    </div>
                </nav>
                <!--  -->
                <section v-for="(color, index) in colors" :key="index">
                    <div
                        v-if="current == index && color.text != null"
                        id="Storycontent"
                        :style="
                            `${color.Background} ; font-family : ${color.Font}`
                        "
                    >
                        <p>{{ color.text }}</p>
                    </div>
                    <div
                        v-if="current == index && color.image != null"
                        id="Storycontent"
                        :style="`${color.Background}`"
                    >
                        <img
                            style="height: 100%; width: 100%; object-fit: contain"
                            :src="color.image"
                            alt=" story_image"
                        />
                    </div>
                </section>
            </div>
            <i
                class="ri-arrow-right-s-line"
                id="nextBTN"
                v-if="current_story < storys.length - 1"
                @click="nextOne"
            ></i>
            <!--  -->
        </div>
    </div>
</template>

<script>
import anime from "animejs/lib/anime.es.js";
import Hammer from "hammerjs";
import EmojiPicker from "vue-emoji-picker";
export default {
    components: {
        EmojiPicker
    },
    data() {
        return {
            current_story: -1,
            hammertime: {},
            timeline: {},
            colors: [],
            current: 0,
            storys: [],
            font: [
                "remixicon",
                "cursive",
                "fantasy",
                "inherit",
                "monospace",
                "Montserrat"
            ],
            color: [
                "background: linear-gradient(40deg, #155263 9%, #155263 43%, #FF6F3C calc(43% + 1px), #FF6F3C 52%, #FF9A3C calc(52% + 1px), #FF9A3C 80%, #FFC93C calc(80% + 1px), #FFC93C 100%);",
                "background: linear-gradient(55deg, #212121 0%, #212121 40%, #323232 calc(40% + 1px), #323232 60%, #008F95 calc(60% + 1px), #008F95 70%, #14FFEC calc(70% + 1px), #14FFEC 100%);",
                "background: linear-gradient(65deg, rgb(7, 26, 82) 3%, rgb(7, 26, 82) 40%, rgb(8, 105, 114) calc(40% + 1px), rgb(8, 105, 114) 60%, rgb(23, 185, 120) calc(60% + 1px), rgb(23, 185, 120) 68%, rgb(167, 255, 131) calc(68% + 1px), rgb(167, 255, 131) 100%)",
                "background: linear-gradient(90deg, #00F0FF 0%, #00F0FF 40%, #0017E3 40%, #0017E3 60%, #000F8F 60%, #000F8F 70%, #00073F 70%, #00073F 100%);",
                "background: linear-gradient(110deg, #FFD9E8 4%, #FFD9E8 40%, #DE95BA calc(40% + 1px), #DE95BA 50%, #7F4A88 calc(50% + 1px), #7F4A88 70%, #4A266A calc(70% + 1px), #4A266A 100%);",
                "background: linear-gradient(60deg, #2B2E4A 0%, #2B2E4A 30%, #E84545 calc(30% + 1px), #E84545 60%, #903749 calc(60% + 1px), #903749 70%, #53354A calc(70% + 1px), #53354A 100%);",
                "background:var(--iq-dark-box)"
            ],
            getBackground: "background:var(--iq-dark-box)",
            getFont: "Montserrat",
            indexColor: 0,
            indexFont: 0,
            search: "",
            StoryText: "",
            showAdd: true,
            showText: true,
            showMedia: true,
            file: null,
            fileUrl: null,
            friends: []
        };
    },
    mounted() {
        this.hammertime = new Hammer(document.getElementById("stories"));
        axios.get("/GetStories").then(res => {
            this.storys = res.data;
        });

        axios
            .post("/LoadFriends", {
                id: null
            })
            .then(res => {
                this.friends = res.data;
            });

        Echo.private(`newStory`).listen("NewStoryEvent", e => {
            if (this.checkFriend(e.story.id) != null) {
                var p = false;
                this.storys.forEach(element => {
                    if (e.story.id == element.id) {
                        var allstories = e.story.stories;
                        var last_story = allstories.slice(
                            Math.max(allstories.length - 1, 0)
                        );

                        element.stories.push(last_story[0]);
                        element.time = e.story.time;
                        p = true;
                    }
                });
                if (p == false) {
                    this.storys.unshift(e.story);
                }
            }
        });
    },
    methods: {
        checkFriend(id) {
            var p = null;
            this.friends.forEach(friend => {
                if (friend.id == id) {
                    p = friend;
                    return true;
                }
            });
            return p;
        },
        nextOne() {
            this.current = 0;
            this.colors = [];
            this.timeline.pause();
            this.timeline.seek(0);

            this.ShowStory(this.storys[this.current_story + 1]);
        },
        previousOne() {
            this.current = 0;
            this.colors = [];
            this.timeline.pause();
            this.timeline.seek(0);

            this.ShowStory(this.storys[this.current_story - 1]);
        },
        close() {
            document.getElementById("showStories").style.display = "none";
            this.current = 0;
            this.colors = [];
            this.timeline.pause();
        },
        ShowStory(story) {
            this.current = 0;
            this.colors = [];
            story.stories.forEach((color, index) => {
                this.colors.push(color);
            });

            this.current_story = this.storys.indexOf(story);

            document.getElementById("showStories").style.display = "flex";

            this.timeline = anime.timeline({
                autoplay: true,
                duration: 4000,
                easing: "linear",
                loop: true
            });

            this.timeline.pause();
            this.timeline.seek(0);
            this.timeline.play();

            this.colors.forEach((color, index) => {
                setTimeout(() => {
                    this.timeline.add({
                        targets: document.getElementById(`id${index}`),
                        width: "100%",
                        changeBegin: a => {
                            this.current = index;
                        }
                    });
                }, 0);
            });

            this.hammertime.off("press");
            this.hammertime.off("pressup");
            this.hammertime.off("tap");

            this.hammertime.on("press", e => {
                this.timeline.pause();
            });

            this.hammertime.on("pressup", e => {
                this.timeline.play();
            });

            this.hammertime.on("tap", e => {
                if (e.center.x > window.innerWidth / 2) {
                    if (this.current < this.colors.length - 1) {
                        this.current += 1;

                        this.timeline.pause();
                        this.timeline.seek(this.current * 4000);
                        this.timeline.play();
                    }
                } else {
                    if (this.current > 0) {
                        this.current -= 1;

                        this.timeline.pause();
                        this.timeline.seek(this.current * 4000);
                        this.timeline.play();
                    }
                }
            });
        },
        append(emoji) {
            if (this.StoryText.length <= 320) {
                this.StoryText += emoji;
            }
        },
        reinitialiser() {
            this.getBackground = "var(--iq-dark-box)";
            this.getFont = "Montserrat";
            this.file = null;
            this.fileUrl = null;
            document.getElementById("addImg").value = "";
            this.StoryText = "";
        },
        addShow() {
            this.showAdd = !this.showAdd;
            this.showMedia = true;
            this.showText = true;
            this.reinitialiser();
        },
        text() {
            this.showText = !this.showText;
            this.showMedia = true;
            this.reinitialiser();
        },
        media() {
            this.showMedia = !this.showMedia;
            this.showText = true;
            this.reinitialiser();
        },
        changeColor() {
            //pp
            this.getBackground = this.color[this.indexColor];
            this.indexColor < 7 ? this.indexColor++ : (this.indexColor = 0);
        },
        changeFont() {
            this.getFont = this.font[this.indexFont];
            this.indexFont < 5 ? this.indexFont++ : (this.indexFont = 0);
        },
        testClick() {
            var p = this.$refs.imagePicker;
            p.click();
        },
        addFile(e) {
            this.file = e.target.files[0];
            this.fileUrl = URL.createObjectURL(this.file);
            document.getElementById("addImg").value = "";
        },
        addStories() {
            var data = new FormData();
            data.append("text", this.StoryText);
            data.append("file", this.file);
            data.append("Background", this.getBackground);
            data.append("Font", this.getFont);
            axios
                .post("/add-storie", data)
                .then(response => {
                    this.reinitialiser();
                    this.showAdd = true;

                    var p = false;
                    this.storys.forEach(element => {
                        if (response.data.id == element.id) {
                            var allstories = response.data.stories;
                            var last_story = allstories.slice(
                                Math.max(allstories.length - 1, 0)
                            );
                            element.stories.push(last_story);
                            element.time = response.data.time;
                            p = true;
                        }
                    });
                    if (p == false) {
                        this.storys.unshift(response.data);
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        }
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
    display: flex;
    justify-content: center;
    align-items: center;
}
.stories {
    position: absolute;
    height: 75vh;
    top: 15%;
    background: aliceblue;
    width: 377px;
}
.addstorie {
    position: relative;
    width: 100px;
    height: 10px;
    background: aliceblue;
}
.edit-storie {
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
.img-add-story {
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
.div-hide {
    display: none !important;
}
.storie-style {
    position: relative;
    width: 100%;
    height: 60px;
}
#div-img {
    border: 1px solid var(--iq-border-dark);
    border-radius: 10px;
}

.nav {
    box-sizing: border-box;
    display: grid;
    grid-column-gap: 0.5em;
    /* grid-template-columns: repeat(3, 1fr); */
    height: 0.3em;
    padding: 0 1em;
    position: fixed;
    width: 377px;
    margin-top: 10px;
}

.nav > div {
    background: rgba(0, 0, 0, 0.25);
    height: 100%;
}

.nav > div > div {
    background: black;
    height: 100%;
    width: 0%;
}

#Storycontent {
    width: 377px;
    height: 520.83px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 30px;
}

.fake {
    position: absolute;
    top: 0%;
    left: 0%;
    height: 100%;
    width: 100%;
    background: transparent;
    z-index: -1;
}

#prevBTN,
#nextBTN {
    position: relative;
    font-size: 50px;
    cursor: pointer;
    color: var(--iq-primary);
    z-index: 11;
    top: 5%;
}

#nextBTN {
    left: 230px;
}

#prevBTN {
    right: 230px;
}
</style>
