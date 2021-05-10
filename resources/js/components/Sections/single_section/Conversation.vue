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
            <div class="chat">
            <div class="chat-user">
                <a class="avatar m-0">
                <img src="images/user/1.jpg" alt="avatar" class="avatar-35 ">
                </a>
                <span class="chat-time mt-1">6:45</span>
            </div>
            <div class="chat-detail">
                <div class="chat-message">
                    <p>How can we help? We're here for you! 😄</p>
                </div>
            </div>
            </div>
            <div class="chat chat-left">
                <div class="chat-user">
                    <a class="avatar m-0">
                    <img src="images/user/05.jpg" alt="avatar" class="avatar-35 ">
                    </a>
                    <span class="chat-time mt-1">6:48</span>
                </div>
                <div class="chat-detail">
                    <div class="chat-message">
                        <p>Hey John, I am looking for the best admin template.</p>
                        <p>Could you please help me to find it out? 🤔</p>
                    </div>
                </div>
            </div>
            <div class="chat">
                <div class="chat-user">
                    <a class="avatar m-0">
                    <img src="images/user/1.jpg" alt="avatar" class="avatar-35 ">
                    </a>
                    <span class="chat-time mt-1">6:49</span>
                </div>
            <div class="chat-detail">
                <div class="chat-message">
                    <p>Absolutely!</p>
                    <p>SocialV Dashboard is the responsive bootstrap 4 admin template.</p>
                </div>
            </div>
            </div>
            <div class="chat chat-left">
             <div class="chat-user">
                <a class="avatar m-0">
                <img src="images/user/05.jpg" alt="avatar" class="avatar-35 ">
                </a>
                <span class="chat-time mt-1">6:52</span>
             </div>
             <div class="chat-detail">
                <div class="chat-message">
                   <p>Looks clean and fresh UI.</p>
                </div>
             </div>
            </div>
            <div class="chat">
             <div class="chat-user">
                <a class="avatar m-0">
                <img src="images/user/1.jpg" alt="avatar" class="avatar-35 ">
                </a>
                <span class="chat-time mt-1">6:53</span>
             </div>
             <div class="chat-detail">
                <div class="chat-message">
                   <p>Thanks, from ThemeForest.</p>
                </div>
             </div>
            </div>
            <div class="chat chat-left">
             <div class="chat-user">
                <a class="avatar m-0">
                <img src="images/user/05.jpg" alt="avatar" class="avatar-35 ">
                </a>
                <span class="chat-time mt-1">6:54</span>
             </div>
             <div class="chat-detail">
                <div class="chat-message">
                   <p>I will purchase it for sure. 👍</p>
                </div>
             </div>
            </div>
            <div class="chat">
             <div class="chat-user">
                <a class="avatar m-0">
                <img src="images/user/1.jpg" alt="avatar" class="avatar-35 ">
                </a>
                <span class="chat-time mt-1">6:56</span>
             </div>
             <div class="chat-detail">
                <div class="chat-message">
                   <p>Okay Thanks..</p>
                </div>
             </div>
            </div>
        </div>
        <div class="chat-footer p-3 bg-white">
            <form class="d-flex align-items-center"  action="javascript:void(0);">
               <div class="chat-attagement d-flex">
                  <a href="javascript:void();"><i class="fa fa-smile-o pr-3" aria-hidden="true"></i></a>
                  <a href="javascript:void();"><i class="fa fa-paperclip pr-3" aria-hidden="true"></i></a>
               </div>
               <input type="text" class="form-control mr-3" placeholder="Type your message">
               <button type="submit" class="btn btn-primary d-flex align-items-center p-2"><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Send</span></button>
            </form>
        </div>
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