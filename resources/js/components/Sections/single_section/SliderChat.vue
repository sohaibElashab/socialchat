<template>
    <div class="chat-sidebar-channel scroller mt-4 pl-3">
        <h5 class="mt-3">Direct Message</h5>
        <ul class="iq-chat-ui nav flex-column nav-pills" v-if="ChatLists">
            <li v-for="(ChatList, index) in ChatLists" :key="index">
                <!-- <a   href="#chatbox1"> -->
                <router-link
                    :to="{
                        name: 'chat',
                        query: { user: ChatList.id }
                    }"
                    :id="`pp${ChatList.id}`"
                    tag="a"
                    :class="ChatList.id == $route.query.user ? 'active' : ''"
                >
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-2">
                            <img
                                :src="ChatList.imgUserChat"
                                alt="chatuserimage"
                                class="avatar-50 "
                            />
                            <span class="avatar-status"
                                ><i
                                    class="ri-checkbox-blank-circle-fill text-success"
                                ></i
                            ></span>
                        </div>
                        <div class="chat-sidebar-name">
                            <h6 class="mb-0">
                                {{ ChatList.NameUserChat }}
                            </h6>
                            <span v-if="ChatList.txtChat != null">{{
                                ChatList.txtChat
                            }}</span>
                        </div>
                        <div
                            class="chat-meta float-right text-center mt-2 mr-1"
                        >
                            <div
                                class="chat-msg-counter bg-primary text-white"
                                v-if="ChatList.numberMsg > 0"
                            >
                                {{ ChatList.numberMsg }}
                            </div>
                            <span class="text-nowrap">{{
                                ChatList.TimeSend
                            }}</span>
                        </div>
                    </div>
                </router-link>
                <!-- </a> -->
            </li>
        </ul>
    </div>
</template>

<script>
import EventBus from "../../../event-bus";
export default {
    props: {
        CurrentUser: {
            type: Object
        }
    },
    data() {
        return {
            id: "",
            OtherUser: null,
            ChatLists: null,
            ChatListss: [
                /*{
                    id: 1,
                    imgUserChat: "images/user/05.jpg",
                    Statu: "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat: "Lorem Ipsum is",
                    numberMsg: "20",
                    TimeSend: "14:02"
                },
                {
                    id: 2,
                    imgUserChat: "images/user/05.jpg",
                    Statu: "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat: "Lorem Ipsum is",
                    numberMsg: "20",
                    TimeSend: "14:02"
                },
                {
                    id: 3,
                    imgUserChat: "images/user/05.jpg",
                    Statu: "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat: "Lorem Ipsum is",
                    numberMsg: "20",
                    TimeSend: "14:02"
                }  ,
                {
                    id: 4,
                    imgUserChat: "images/user/05.jpg",
                    Statu: "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat: "Lorem Ipsum is",
                    numberMsg: "20",
                    TimeSend: "14:02"
                } */
            ]
        };
    },
    mounted() {
        //this.loadList();
        axios.get("/ChatList").then(res => {
            console.log("list");
            console.log(res.data);
            this.ChatLists = res.data;
            if (
                this.findUser(this.$route.query.user) == null &&
                this.$route.query.user
            ) {
                this.AddUserToList();
            }
            this.ChatLists.forEach(u => {
                if (u.id == this.$route.query.user) {
                    var index = this.ChatLists.indexOf(u);
                    this.ChatLists[index].numberMsg = 0;
                }
            });
            Echo.private(`sendText.${this.CurrentUser.id}`).listen(
                "SendTextEvent",
                e => {
                    console.log(e);
                    //console.log(e.message);
                    if (e.message.user_id != this.$route.query.user) {
                        var p = false;
                        this.ChatLists.forEach(u => {
                            if (u.id == e.message.user_id) {
                                var index = this.ChatLists.indexOf(u);
                                this.ChatLists[index].numberMsg += 1;
                                this.ChatLists[index].TimeSend = e.message.time;
                                if (e.message.image != null) {
                                    this.ChatLists[index].txtChat =
                                        "Sent an image";
                                } else if (e.message.video != null) {
                                    this.ChatLists[index].txtChat =
                                        "Sent a video";
                                } else {
                                    this.ChatLists[index].txtChat =
                                        e.message.text;
                                }
                                p = true;
                            }
                        });
                        if (p == false) {
                            axios
                                .post("/UserProfile", {
                                    id: e.message.user_id
                                })
                                .then(res => {
                                    var user = res.data;
                                    var txxt;
                                    if (e.message.image != null) {
                                        txxt = "Sent an image";
                                    } else if (e.message.video != null) {
                                        txxt = "Sent a video";
                                    } else {
                                        txxt = e.message.text;
                                    }
                                    var item = {
                                        id: e.message.user_id,
                                        imgUserChat:
                                            "images/user/" +
                                            user.profileimg.name,
                                        NameUserChat: user.name,
                                        txtChat: txxt,
                                        numberMsg: 1,
                                        TimeSend: e.message.time
                                    };
                                    console.log("item");
                                    console.log(item);
                                    this.ChatLists.unshift(item);
                                });
                        }
                    }
                    if (e.message.user_id == this.$route.query.user) {
                        this.ChatLists.forEach(u => {
                            if (u.id == e.message.user_id) {
                                var index = this.ChatLists.indexOf(u);
                                this.ChatLists[index].TimeSend = e.message.time;
                                if (e.message.image != null) {
                                    this.ChatLists[index].txtChat =
                                        "Sent an image";
                                } else if (e.message.video != null) {
                                    this.ChatLists[index].txtChat =
                                        "Sent a video";
                                } else {
                                    this.ChatLists[index].txtChat =
                                        e.message.text;
                                }
                                //this.ChatLists[index].txtChat = e.message.text;
                            }
                        });
                    }
                }
            );
        });
        EventBus.$on("last-text", this.LastText);
        EventBus.$on("delete-chat", this.DeleteChat);
    },
    methods: {
        DeleteChat(data) {
            var item = this.findUser(data);
            var index = this.ChatLists.indexOf(item);
            this.ChatLists.splice(index, 1);
        },
        LastText(data) {
            console.log(data);
            this.ChatLists.forEach(u => {
                if (u.id == this.$route.query.user) {
                    var index = this.ChatLists.indexOf(u);
                    this.ChatLists[index].TimeSend = data.TimeSend;
                    this.ChatLists[index].txtChat = data.txtChat;
                }
            });
        },
        loadList() {
            axios.get("/ChatList").then(res => {
                //console.log("list");
                //console.log(res.data);
                this.ChatLists = res.data;
                if (
                    this.findUser(this.$route.query.user) == null &&
                    this.$route.query.user
                ) {
                    this.AddUserToList();
                }
            });
            //ChatLists
        },
        findUser(id) {
            var p = null;

            this.ChatLists.forEach(u => {
                if (u.id == id) {
                    p = u;
                    return true;
                }
            });

            return p;
        },
        AddUserToList() {
            axios
                .post("/UserProfile", {
                    id: this.$route.query.user
                })
                .then(res => {
                    //console.log("unshift");
                    this.OtherUser = res.data;
                    var time = new Date();
                    var person = {
                        id: this.$route.query.user,
                        imgUserChat:
                            "images/user/" + this.OtherUser.profileimg.name,
                        NameUserChat: this.OtherUser.name,
                        txtChat: "",
                        numberMsg: 0,
                        TimeSend: time.getHours() + ":" + time.getMinutes() // =>  30 // => 9
                    };

                    this.ChatLists.unshift(person);
                });
        }
    },
    watch: {
        "$route.query.user": function() {
            if (
                this.findUser(this.$route.query.user) == null &&
                this.$route.query.user
            ) {
                this.AddUserToList();

                //console.log("changer id");
            }
            this.ChatLists.forEach(u => {
                if (u.id == this.$route.query.user) {
                    var index = this.ChatLists.indexOf(u);
                    this.ChatLists[index].numberMsg = 0;
                    console.log("change to 0");
                }
            });
        }
    }
};
</script>
