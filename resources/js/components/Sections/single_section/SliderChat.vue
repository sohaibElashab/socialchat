<template>
    <div class="chat-sidebar-channel scroller mt-4 pl-3">
        <h5 class="mt-3">Direct Message</h5>
        <ul class="iq-chat-ui nav flex-column nav-pills">
            <li v-for="ChatList in ChatLists" :key="ChatList">
                <a  data-toggle="pill" href="#chatbox1">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-2">
                            <img :src="ChatList.imgUserChat" alt="chatuserimage" class="avatar-50 ">
                            <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill text-success"></i></span>
                        </div>
                        <div class="chat-sidebar-name">
                            <h6 class="mb-0">{{ChatList.NameUserChat}}</h6>
                            <span>{{ChatList.txtChat}}</span>
                        </div>
                        <div class="chat-meta float-right text-center mt-2 mr-1">
                            <div class="chat-msg-counter bg-primary text-white">{{ChatList.numberMsg}}</div>
                            <span class="text-nowrap">{{ChatList.TimeSend}}</span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        ChatLists : {
            require: true,
            type: Object
        }
    }
}
</script>