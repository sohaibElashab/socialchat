<template>
    <div class="chat-footer p-3 bg-white">
        <form 
            class="d-flex align-items-center"
            id="fooorm"
            enctype="multipart/form-data"
        >
            <div class="chat-attagement d-flex">
                <label for="input"
                    ><i class="fa fa-paperclip pr-3" aria-hidden="true"></i
                ></label>
                <input
                    id="input"
                    ref="prof"
                    style="display:none;"
                    type="file"
                    accept="image/*,video/mp4,video/x-m4v,video/*"
                    @change="onProfileChange"
                />
            </div>
            <div class="wrapper">
                <textarea
                    class="regular-input"
                    placeholder="Message..."
                    v-model="input"
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
            </div>
            <button
                class="btn btn-primary d-flex align-items-center p-2"
                style=" margin-left: 10px; "
                @click="send"
            >
                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                <span class="d-none d-lg-block ml-1">Send</span>
            </button>
        </form>
    </div>
</template>

<script>
import VueEmoji from "emoji-vue";
import EventBus from "../../../event-bus";
import EmojiPicker from "vue-emoji-picker";
export default {
    data() {
        return {
            myText: "",
            file: null,
            name_img: null,
            urlFile: null,
            input: "",
            search: ""
        };
    },
    props: {
        CurrentUser: {
            type: Object
        }
    },
    mounted() {
        EventBus.$on("reset-form", this.resetForm);
    },
    methods: {
        append(emoji) {
            this.input += emoji;
        },
        resetForm(data) {
            document.getElementById("fooorm").reset();
        },
        clearTextarea() {
            this.input = "";
        },
        send(e) {
            e.preventDefault();
            if (
                this.name_img != null &&
                this.name_img.type.substring(0, 5) == "image"
            ) {
                this.$emit("send", [this.name_img, "image"]);
                this.clearTextarea();
                this.name_img = null;
                document.getElementById("fooorm").reset();
            } else if (
                this.name_img != null &&
                this.name_img.type.substring(0, 5) == "video"
            ) {
                this.$emit("send", [this.name_img, "video"]);
                this.clearTextarea();
                this.name_img = null;
            } else if (this.input != "" && this.name_img == null) {
                this.$emit("send", [this.input, "text"]);
                this.clearTextarea();
                this.name_img = null;
            }
        },
        onProfileChange(e) {
            var file = e.target.files[0];
            this.name_img = file;
            this.urlFile = URL.createObjectURL(file);
            this.$emit("addFile", {
                url: this.urlFile,
                type: this.name_img.type.substring(0, 5)
            });
            this.$refs.prof.clear();
            this.clearTextarea();
        }
    },
    components: {
        VueEmoji,
        EmojiPicker
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
.wrapper {
    position: relative;
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}
.regular-input {  
    position: relative;
    width: 90%;
    height: 50px;
    background: transparent;
    color: var(--iq-dark-body-text);
    border: 1px solid var(--iq-border-dark);
    border-radius: 10px;
    padding: 0rem 1rem;
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
    top: 1rem;
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
