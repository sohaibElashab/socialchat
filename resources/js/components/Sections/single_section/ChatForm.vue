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
            <div class="wrapper-emoji">
                <textarea
                    class="regular-input"
                    placeholder="Message..."
                    v-model="input"
                    @keypress.enter="send"
                ></textarea>

                <emoji-picker @emoji="append" :search="search">
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
.emoji-picker {
    top: -20rem;
}
</style>
