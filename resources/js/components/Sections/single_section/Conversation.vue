<template>
    <div>
        <div class="chat-head">
            <header
                class="d-flex justify-content-between align-items-center bg-white pt-3 pr-3 pb-3"
            >
                <div class="d-flex align-items-center" v-if="OtherUser">
                    <div class="sidebar-toggle">
                        <i class="ri-menu-3-line"></i>
                    </div>
                    <div class="avatar chat-user-profile m-0 mr-3">
                        <img
                            :src="`images/user/${OtherUser.profileimg.name}`"
                            alt="avatar"
                            class="avatar-50 "
                        />
                        <!--   <span class="avatar-status"
                            ><i
                                class="ri-checkbox-blank-circle-fill text-success"
                            ></i
                        ></span> -->
                    </div>
                    <h5 class="mb-0">{{ OtherUser.name }}</h5>
                </div>
                <div class="chat-user-detail-popup scroller"></div>
                <div class="chat-header-icons d-flex">
                    <router-link
                        :to="{
                            name: 'profile',
                            query: { user: OtherUser.id }
                        }"
                        tag="a"
                        class="iq-bg-primary"
                        v-if="OtherUser"
                    >
                        <i class="ri-user-fill"></i>
                    </router-link>
                    <a @click="deleteChat" class="iq-bg-primary">
                        <i class="ri-delete-bin-5-line"></i>
                    </a>
                </div>
            </header>
        </div>
        <div class="file" v-if="isFile">
            <button class="delete-btn">
                <i class="ri-delete-bin-line" @click="removeFile"></i>
            </button>
            <img
                :src="isFile"
                class="contentFile"
                alt="image upload"
                v-if="typeFile == 'image'"
            />
            <video controls class="contentFile" v-else>
                <source :src="isFile" type="video/mp4" />
                <source :src="isFile" type="video/webm" />
                <p>
                    Votre navigateur ne prend pas en charge les vidéos HTML5.
                    Voici
                    <a :href="isFile">un lien pour télécharger la vidéo</a>.
                </p>
            </video>
        </div>
        <div class="chat-content scroller" ref="feed">
            <div
                class="chat"
                :class="ChatContent.MsgFor"
                v-for="ChatContent in ChatContents"
                :key="ChatContent.id"
            >
                <div class="chat-user">
                    <a class="avatar m-0">
                        <img
                            :src="ChatContent.imgUserChat"
                            alt="avatar"
                            class="avatar-35 "
                        />
                    </a>
                    <span class="chat-time mt-1">{{
                        ChatContent.TimeSend
                    }}</span>
                </div>
                <div class="chat-detail">
                    <div
                        class="chat-message"
                        v-if="ChatContent.txtChat != null"
                    >
                        <div
                            v-if="
                                ChatContent.txtChat.substring(0, 4) == 'http' &&
                                    ChatContent.MsgFor == '' &&
                                    load_share
                            "
                        >
                            <h6 style="color:white">Shared post</h6>
                            <hr />
                            <div
                                class="iq-waves-effect d-flex align-items-center"
                            >
                                <img
                                    :src="
                                        `images/user/${ChatContent.share_image}`
                                    "
                                    class="img-fluid rounded-circle mr-3"
                                    alt="user"
                                    v-if="ChatContent.share_image != null"
                                    style="height:50px;width:50px"
                                />
                                <router-link
                                    :to="{
                                        name: 'profile',
                                        query: { user: ChatContent.share_id }
                                    }"
                                    tag="a"
                                    class="caption"
                                    v-if="ChatContent.share_name != null"
                                >
                                    <h6
                                        class="mb-0 line-height"
                                        style="color:#1E2745"
                                    >
                                        {{ ChatContent.share_name }}
                                    </h6>
                                </router-link>
                            </div>

                            <hr />
                            <a
                                :href="ChatContent.txtChat"
                                style="color:#1E2745"
                                >{{ ChatContent.txtChat }}</a
                            >
                        </div>

                        <div
                            v-else-if="
                                ChatContent.txtChat.substring(0, 4) == 'http' &&
                                    ChatContent.MsgFor != '' &&
                                    load_share
                            "
                        >
                            <h6 style="color:white">Shared post</h6>
                            <hr />
                            <div
                                class="iq-waves-effect d-flex align-items-center"
                            >
                                <img
                                    :src="
                                        `images/user/${ChatContent.share_image}`
                                    "
                                    class="img-fluid rounded-circle mr-3"
                                    alt="user"
                                    v-if="ChatContent.share_image != null"
                                    style="height:50px;width:50px"
                                /><!-- share_id -->
                                <router-link
                                    :to="{
                                        name: 'profile',
                                        query: { user: ChatContent.share_id }
                                    }"
                                    tag="a"
                                    class="caption"
                                    v-if="ChatContent.share_name != null"
                                >
                                    <h6
                                        class="mb-0 line-height"
                                        style="color:#50B5FF"
                                    >
                                        {{ ChatContent.share_name }}
                                    </h6>
                                </router-link>
                            </div>

                            <hr />
                            <a
                                :href="ChatContent.txtChat"
                                style="color:#50B5FF"
                                >{{ ChatContent.txtChat }}</a
                            >
                        </div>

                        <p v-else>{{ ChatContent.txtChat }}</p>
                    </div>
                    <div
                        class="chat-message"
                        v-if="ChatContent.imgChat != null"
                    >
                        <img
                            :src="ChatContent.imgChat"
                            alt="post-image"
                            style="height:300px;width:300px"
                        />
                    </div>
                    <div
                        class="chat-message"
                        v-if="ChatContent.vidChat != null"
                    >
                        <video controls style="height:300px;width:300px">
                            <source
                                :src="ChatContent.vidChat"
                                type="video/mp4"
                            />
                            <source
                                :src="ChatContent.vidChat"
                                type="video/webm"
                            />
                            <p>
                                Votre navigateur ne prend pas en charge les
                                vidéos HTML5. Voici
                                <a :href="ChatContent.vidChat"
                                    >un lien pour télécharger la vidéo</a
                                >.
                            </p>
                        </video>
                    </div>
                    <!-- -->
                </div>
            </div>
        </div>
        <ChatForm
            @addFile="newFile"
            @send="newMessage"
            :CurrentUser="CurrentUser"
        />
    </div>
</template>

<script>
import ChatForm from "./ChatForm";
import EventBus from "../../../event-bus";
export default {
    components: {
        ChatForm
    },
    props: {
        CurrentUser: {
            type: Object
        }
    },
    data() {
        return {
            OtherUser: null,
            ChatContents: null,
            isFile: null,
            typeFile: null,
            load_share: false,
            watch_chat: false
        };
    },
    mounted() {
        EventBus.$emit("reload-uread", { data: "z" });
        if (this.$route.query.user) {
            this.loadOtherUser();
            this.LoadMessages();
            Echo.private(`sendText.${this.CurrentUser.id}`).listen(
                "SendTextEvent",
                e => {
                    console.log(e);
                    if (e.message.user_id == this.$route.query.user) {
                        var message = {
                            id: e.message.id,
                            txtChat: e.message.text,
                            vidChat: e.message.video,
                            imgChat: e.message.image,
                            TimeSend: e.message.time,
                            imgUserChat:
                                "images/user/" + this.OtherUser.profileimg.name,
                            MsgFor: "chat-left"
                        };

                        if (
                            message.txtChat != null &&
                            message.txtChat.substring(0, 4) == "http"
                        ) {
                            axios
                                .post("/userInfoReq", {
                                    id: message.txtChat.split("postId=")[1]
                                })
                                .then(res => {
                                    message.share_name = res.data.name;
                                    message.share_id = res.data.id;
                                    message.share_image =
                                        res.data.profileimg.name;
                                    this.ChatContents.push(message);
                                    this.scrollToBottom();
                                });
                        } else {
                            this.ChatContents.push(message);
                            this.scrollToBottom();
                        }
                    }
                    this.scrollToBottom();
                }
            );
        }
    },
    methods: {
        deleteChat() {
            axios
                .post("/DeleteChat", {
                    id: this.CurrentUser.id,
                    messages: this.ChatContents
                })
                .then(res => {
                    this.ChatContents = [];
                    EventBus.$emit("delete-chat", this.$route.query.user);
                    this.$router.push({ name: "chat" });
                });
        },
        scrollToBottom() {
            setTimeout(() => {
                if (this.ChatContents && this.$refs.feed) {
                    this.$refs.feed.scrollTop = 99999;
                }
            }, 50);
        },
        async LoadMessages() {
            this.load_share = false;

            await axios
                .post("/LoadMessages", {
                    id: this.$route.query.user
                })
                .then(res => {
                    this.ChatContents = res.data;
                });

            for (const element of this.ChatContents) {
                if (element.txtChat != null && element.txtChat.substring(0, 4) == "http") {
                    await axios
                        .post("/userInfoReq", {
                            id: element.txtChat.split("postId=")[1]
                        })
                        .then(res => {
                            element.share_name = res.data.name;
                            element.share_id = res.data.id;
                            element.share_image = res.data.profileimg.name;
                        });
                }
            }
            this.scrollToBottom();
            this.load_share = true;
            this.watch_chat = true;
        },
        loadOtherUser() {
            axios
                .post("/UserProfile", {
                    id: this.$route.query.user
                })
                .then(res => {
                    this.OtherUser = res.data;
                });
        },
        newMessage(text) {
            var d = new Date();
            var time = d.getHours() + ":" + d.getMinutes();
            if (text[1] == "image") {
                var img = URL.createObjectURL(text[0]);
                var newT = {
                    txtChat: null,
                    imgChat: img,
                    vidChat: null,
                    imgUserChat:
                        "images/user/" + this.CurrentUser.profileimg.name,
                    TimeSend: time
                };
                let data = new FormData();
                data.append("id", this.OtherUser.id);
                data.append("text", newT.txtChat);
                data.append("image", text[0]);
                data.append("video", newT.vidChat);
                data.append("time", newT.TimeSend);
                axios.post("/NewMessage", data).then(res => {
                    newT.id = res.data.id;
                    this.ChatContents.push(newT);
                    var txt = {
                        txtChat: "Sent an image",
                        TimeSend: time
                    };
                    EventBus.$emit("last-text", txt);
                    this.scrollToBottom();
                });
            } else if (text[1] == "video") {
                var vid = URL.createObjectURL(text[0]);
                var newT = {
                    txtChat: null,
                    imgChat: null,
                    vidChat: vid,
                    imgUserChat:
                        "images/user/" + this.CurrentUser.profileimg.name,
                    TimeSend: time
                };

                let data = new FormData();
                data.append("id", this.OtherUser.id);
                data.append("text", newT.txtChat);
                data.append("image", newT.imgChat);
                data.append("video", text[0]);
                data.append("time", newT.TimeSend);
                axios.post("/NewMessage", data).then(res => {
                    newT.id = res.data.id;
                    this.ChatContents.push(newT);

                    var txt = {
                        txtChat: "Sent a video",
                        TimeSend: time
                    };
                    EventBus.$emit("last-text", txt);
                    this.scrollToBottom();
                });
            } else if (text[1] == "text") {
                var newT = {
                    txtChat: text[0],
                    imgChat: null,
                    vidChat: null,
                    imgUserChat:
                        "images/user/" + this.CurrentUser.profileimg.name,
                    TimeSend: time
                };

                let data = new FormData();
                data.append("id", this.OtherUser.id);
                data.append("text", newT.txtChat);
                data.append("image", newT.imgChat);
                data.append("video", newT.vidChat);
                data.append("time", newT.TimeSend);
                axios.post("/NewMessage", data).then(res => {
                    newT.id = res.data.id;
                    this.ChatContents.push(newT);
                    var txt = {
                        txtChat: text[0],
                        TimeSend: time
                    };
                    EventBus.$emit("last-text", txt);
                    this.scrollToBottom();
                });
            }
            this.isFile = null;
            this.typeFile = null;
        },
        newFile(file) {
            this.isFile = file.url;
            this.typeFile = file.type;
        },
        removeFile() {
            this.isFile = null;
            this.typeFile = null;
            EventBus.$emit("reset-form", true);
        }
    },
    watch: {
        "$route.query.user": function() {
            this.loadOtherUser();
            this.LoadMessages();
            EventBus.$emit("reload-uread", { data: "z" });
        }
    }
};
</script>

<style scoped>
.file {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 70%;
    background: var(--iq-light-info);
    display: flex;
    justify-content: center;
    align-items: center;
}
.file > .contentFile {
    position: relative;
    width: 90%;
    height: 90%;
}
.delete-btn {
    position: absolute;
    top: 8px;
    right: 5px;
    background: var(--iq-white);
    height: 25px;
    width: 25px;
    text-align: center;
    border: none;
    border-radius: 5px;
    opacity: 0;
    z-index: 1;
}
.file:hover .delete-btn {
    opacity: 1;
    transition: all 0.45s ease 0s;
}
.delete-btn > i {
    color: var(--iq-primary);
}

.chat-content .chat-left .chat-message {
    background-color: #141a2f;
}
</style>
