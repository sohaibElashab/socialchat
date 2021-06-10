<template>
    <div class="chat-footer p-3 bg-white">
        <form
            class="d-flex align-items-center"
            id="fooorm"
            enctype="multipart/form-data"
        >
            <div class="chat-attagement d-flex">
                <label for="input"
                    ><i
                        class="fa fa-paperclip pr-3"
                        aria-hidden="true"
                        
                    ></i
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
            <!-- <img :src="urlFile" alt=""> -->
            <!--   <input
                type="text"
                v-model="myText"
                class="form-control mr-3"
                placeholder="Type your message"
            /> -->
            <VueEmoji
                ref="emoji"
                @input="onInput"
                height="65px"
                class="emoji-div"
            /><!--  :value="myText"-->
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
export default {
    data() {
        return {
            myText: "",
            file: null,
            name_img: null,
            urlFile: null
        };
    },
    props: {
        CurrentUser: {
            type: Object
        }
    },
    methods: {
        onInput(event) {
            //event.data contains the value of the textarea
            //console.log(event.data);
            this.myText = event.data;
        },
        clearTextarea() {
            this.$refs.emoji.clear();
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
            } else if (this.myText != "" && this.name_img == null) {
                this.$emit("send", [this.myText, "text"]);
                this.clearTextarea();
                this.name_img = null;
            }
        },
        onProfileChange(e) {
            var file = e.target.files[0];
            this.name_img = file;
            this.urlFile = URL.createObjectURL(file);
            this.$emit('addFile',{
                url : this.urlFile,
                type : this.name_img.type.substring(0, 5)
            });
            this.$refs.prof.clear();
            this.clearTextarea();
        }
    },
    components: {
        VueEmoji
    }
};
</script>
