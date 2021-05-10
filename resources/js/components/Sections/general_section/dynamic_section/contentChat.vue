<template>
<div id="content-page" class="content-page">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-body chat-page p-0">
                           <div class="chat-data-block">
                              <div class="row">
                                 <div class="col-lg-3 chat-data-left scroller">
                                    <div class="chat-search pt-3 pl-3">
                                       <div class="d-flex align-items-center">
                                          <div class="chat-profile mr-3">
                                             <img src="images/user/1.jpg" alt="chat-user" class="avatar-60 ">
                                          </div>
                                          <div class="chat-caption">
                                             <h5 class="mb-0">Bni Jordan</h5>
                                             <p class="m-0">Web Designer</p>
                                          </div>
                                          <button type="submit" class="close-btn-res p-3"><i class="ri-close-fill"></i></button>
                                       </div>
                                       <div id="user-detail-popup" class="scroller">
                                          <div class="user-profile">
                                             <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                                             <div class="user text-center mb-4">
                                                <a class="avatar m-0">
                                                <img src="images/user/1.jpg" alt="avatar">
                                                </a>
                                                <div class="user-name mt-4">
                                                   <h4>Bni Jordan</h4>
                                                </div>
                                                <div class="user-desc">
                                                   <p>Web Designer</p>
                                                </div>
                                             </div>
                                             <hr>
                                             <div class="user-detail text-left mt-4 pl-4 pr-4">
                                                <h5 class="mt-4 mb-4">About</h5>
                                                <p>It is long established fact that a reader will be distracted bt the reddable.</p>
                                                <h5 class="mt-3 mb-3">Status</h5>
                                                <ul class="user-status p-0">
                                                   <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-success pr-1"></i><span>Online</span></li>
                                                   <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-warning pr-1"></i><span>Away</span></li>
                                                   <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-danger pr-1"></i><span>Do Not Disturb</span></li>
                                                   <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-light pr-1"></i><span>Offline</span></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="chat-searchbar mt-4">
                                          <div class="form-group chat-search-data m-0">
                                             <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                             <i class="ri-search-line"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <SliderChat :ChatLists="ChatLists" />
                                 </div>
                                 <div class="col-lg-9 chat-data p-0 chat-data-right">
                                    <div class="tab-content">
                                       <div class="tab-pane fade active show" id="default-block" role="tabpanel">
                                          <div class="chat-start">
                                             <span class="iq-start-icon text-primary"><i class="ri-message-3-line"></i></span>
                                             <button id="chat-start" class="btn bg-white mt-3">Start
                                             Conversation!</button>
                                          </div>
                                       </div>
                                       <Conversation :ChatContents="ChatContents"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</template>

<script>
import SliderChat from '../../single_section/SliderChat.vue'
import Conversation from '../../single_section/Conversation.vue'

export default {
    components:{
        SliderChat,
        Conversation
    } ,  
        data() {
        return {
            ChatLists : {
                "1" : {
                    id: 1,
                    imgUserChat: "images/user/05.jpg",
                    Statu : "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat : "Lorem Ipsum is",
                    numberMsg : "20",
                    TimeSend : "14:02"
                },
                "2" : {
                    id: 2,
                    imgUserChat: "images/user/05.jpg",
                    Statu : "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat : "Lorem Ipsum is",
                    numberMsg : "20",
                    TimeSend : "14:02"
                },
                "3" : {
                    id: 3,
                    imgUserChat: "images/user/05.jpg",
                    Statu : "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat : "Lorem Ipsum is",
                    numberMsg : "20",
                    TimeSend : "14:02"
                },
                "4" : {
                    id: 4,
                    imgUserChat: "images/user/05.jpg",
                    Statu : "Find new friends",
                    NameUserChat: "Team Discussions",
                    txtChat : "Lorem Ipsum is",
                    numberMsg : "20",
                    TimeSend : "14:02"
                },
            },
            ChatContents : {
               "1" : {
                  id: 1,
                  imgUserChat: "images/user/05.jpg",
                  txtChat : "How can we help? We're here for you! 😄",
                  TimeSend : "14:02",
                  MsgFor : ""
               },
               "2" : {
                  id: 2,
                  imgUserChat: "images/user/05.jpg",
                  txtChat : "How can we help? We're here for you! 😄",
                  TimeSend : "14:02",
                  MsgFor : "chat-left"
               },
               "3" : {
                  id: 3,
                  imgUserChat: "images/user/05.jpg",
                  txtChat : "How can we help? We're here for you! 😄",
                  TimeSend : "14:02",
                  MsgFor : ""
               },
               "4" : {
                  id: 4,
                  imgUserChat: "images/user/05.jpg",
                  txtChat : "How can we help? We're here for you! 😄",
                  TimeSend : "14:02",
                  MsgFor : "chat-left"
               },
            }
        }
    }
}
</script>