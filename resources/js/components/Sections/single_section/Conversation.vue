<template>
    <div>
        <div class="chat-head">
            <!--class="tab-pane fade" id="chatbox1" role="tabpanel" -->
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
                        <span class="avatar-status"
                            ><i
                                class="ri-checkbox-blank-circle-fill text-success"
                            ></i
                        ></span>
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

                    <a href="javascript:void();" class="iq-bg-primary">
                        <i class="ri-vidicon-2-fill"></i>
                    </a>
                    <a @click="deleteChat" class="iq-bg-primary">
                        <i class="ri-delete-bin-5-line"></i>
                    </a>
                </div>
            </header>
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
                        <p>{{ ChatContent.txtChat }}</p>
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
        <ChatForm @send="newMessage" :CurrentUser="CurrentUser" />
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
            ChatContents: null
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
                    //console.log(e.message);
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

                        this.ChatContents.push(message);
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
                    console.log("deleted");
                    console.log(res.data);
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
        LoadMessages() {
            axios
                .post("/LoadMessages", {
                    id: this.$route.query.user
                })
                .then(res => {
                    console.log("messages");
                    console.log(res.data);
                    this.ChatContents = res.data;

                    this.scrollToBottom();
                });
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
            console.log("text");
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
                    console.log("id");
                    console.log(res.data);
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
                    //console.log(res);
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
                    /* console.log("id");
                    console.log(res.data); */
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
