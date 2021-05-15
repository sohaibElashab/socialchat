<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div
                            class="iq-card-header d-flex justify-content-between"
                        >
                            <div class="iq-header-title">
                                <h4 class="card-title">
                                    Friend Request
                                </h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul
                                class="request-list list-inline m-0 p-0"
                            >
                                <li class="d-flex align-items-center" v-for="friendRq in friendRqs" :key="friendRq.id"> 
                                    <div class="user-img img-fluid">
                                        <img
                                            :src="friendRq.imgUser"
                                            alt="story-img"
                                            class="rounded-circle avatar-40"
                                        />
                                    </div>
                                    <div
                                        class="media-support-info ml-3"
                                    >
                                        <h6>{{friendRq.UserName}}</h6>
                                        <p class="mb-0">{{friendRq.NbrFriend}} friends</p>
                                    </div>
                                    <div
                                        class="d-flex align-items-center"
                                    >
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-primary rounded"
                                            >Confirm</a
                                        >
                                        <a
                                            href="javascript:void();"
                                            class="mr-3 btn btn-secondary rounded"
                                            >Delete Request</a
                                        >
                                    </div>
                                </li>
                                <li class="d-block text-center">
                                    <a href="#" class="btn btn-request"
                                        >View More Request</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="iq-card">
                        <div
                            class="iq-card-header d-flex justify-content-between"
                        >
                            <div class="iq-header-title">
                                <h4 class="card-title">
                                    People You May Know
                                </h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="request-list m-0 p-0">
                                <li class="d-flex align-items-center" v-for="friendKnow in friendKnows" :key="friendKnow.id">
                                            <div class="user-img img-fluid">
                                                <img
                                                    :src="friendKnow.imgUser"
                                                    alt="story-img"
                                                    class="rounded-circle avatar-40"
                                                />
                                            </div>
                                            <div
                                                class="media-support-info ml-3"
                                            >
                                                <h6>{{friendKnow.UserName}}</h6>
                                                <p class="mb-0">{{friendKnow.NbrFriend}} friends</p>
                                            </div>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <a
                                                    href="javascript:void();"
                                                    class="mr-3 btn btn-primary rounded"
                                                    ><i
                                                        class="ri-user-add-line"
                                                    ></i
                                                    >Add Friend</a
                                                >
                                                <a
                                                    href="javascript:void();"
                                                    class="mr-3 btn btn-secondary rounded"
                                                    >Remove</a
                                                >
                                            </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
        data() {
        return {
            friendRqs : {
                "1" : {
                    id: 1,
                    imgUser: "images/user/05.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "2" : {
                    id: 2,
                    imgUser: "images/user/05.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "3" : {
                    id: 3,
                    imgUser: "images/user/05.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "4" : {
                    id: 4,
                    imgUser: "images/user/05.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
            },
            friendKnows : {
                "1" : {
                    id: 1,
                    imgUser: "images/user/15.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "2" : {
                    id: 2,
                    imgUser: "images/user/15.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "3" : {
                    id: 3,
                    imgUser: "images/user/15.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
                "4" : {
                    id: 4,
                    imgUser: "images/user/15.jpg",
                    UserName : "Jaques Amole",
                    NbrFriend : "40",
                },
            },
        }
    }
}
</script>