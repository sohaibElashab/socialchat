<template>
    <div class="tab-pane fade" id="chatbox1" role="tabpanel">
        <div class="chat-head">
            <header class="d-flex justify-content-between align-items-center bg-white pt-3 pr-3 pb-3">
                <div class="d-flex align-items-center">
                    <div class="sidebar-toggle">
                        <i class="ri-menu-3-line"></i>
                    </div>
                    <div class="avatar chat-user-profile m-0 mr-3">
                        <img src="images/user/05.jpg" alt="avatar" class="avatar-50 ">
                        <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill text-success"></i></span>
                    </div>
                    <h5 class="mb-0">Team Discussions</h5>
                </div>
                <div class="chat-user-detail-popup scroller"></div>
                <div class="chat-header-icons d-flex">
                    <a href="javascript:void();" class="iq-bg-primary">
                        <i class="ri-user-fill"></i>
                    </a>
                    <a href="javascript:void();" class="iq-bg-primary">
                        <i class="ri-vidicon-2-fill"></i>
                    </a>
                    <a href="javascript:void();" class="iq-bg-primary">
                        <i class="ri-delete-bin-5-line"></i>
                    </a>
                </div>
            </header>
        </div>
        <div class="chat-content scroller">
            <div class="chat" :class="ChatContent.MsgFor" v-for="ChatContent in ChatContents" :key="ChatContent.id">
                <div class="chat-user">
                    <a class="avatar m-0">
                    <img :src="ChatContent.imgUserChat" alt="avatar" class="avatar-35 ">
                    </a>
                    <span class="chat-time mt-1">{{ChatContent.TimeSend}}</span>
                </div>
                <div class="chat-detail">
                    <div class="chat-message">
                        <p>{{ChatContent.txtChat}}</p>
                    </div>
                </div>
            </div>
        </div>
        <ChatForm/>
    </div>
</template>

<script>
import ChatForm from './ChatForm';
export default {
    components: {
        ChatForm
    },
    props: {
        ChatLists : {
            require: true,
            type: Object
        },
        ChatContents : {
            require: true,
            type: Object
        }
    },
}
</script>