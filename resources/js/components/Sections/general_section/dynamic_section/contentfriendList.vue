<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6" v-for="friend in friends" :key="friend.id">
                    <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header-image">
                                <div class="cover-container">
                                    <img
                                        :src="friend.coverImage"
                                        alt="profile-bg"
                                        class="rounded img-fluid w-100"
                                    />
                                </div>
                                <div class="profile-info p-4">
                                    <div class="user-detail">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-start"
                                        >
                                            <div
                                                class="profile-detail d-flex"
                                            >
                                                <div
                                                    class="profile-img pr-4"
                                                >
                                                    <img
                                                        :src="friend.profileImg"
                                                        alt="profile-img"
                                                        class="avatar-130 img-fluid"
                                                    />
                                                </div>
                                                <div
                                                    class="user-data-block"
                                                >
                                                    <h4 class="">
                                                        {{friend.Name}}
                                                    </h4>
                                                    <h6>{{friend.Interests}}</h6>
                                                    <p>
                                                        {{friend.About}}
                                                    </p>
                                                </div>
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Visit profile
                                            </button>
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
export default {
        data() {
        return {
            friends : {
                "1" : {
                    id: 1,
                    profileImg: "images/user/05.jpg",
                    coverImage : "images/page-img/profile-bg2.jpg",
                    Name : "Anna Sthesia",
                    Interests : "@designer",
                    About : "Lorem Ipsum is simply dummy text of the",
                },
                "2" : {
                    id: 2,
                    profileImg: "images/user/05.jpg",
                    coverImage : "images/page-img/profile-bg2.jpg",
                    Name : "Anna Sthesia",
                    Interests : "@designer",
                    About : "Lorem Ipsum is simply dummy text of the",
                },
                "3" : {
                    id: 3,
                    profileImg: "images/user/05.jpg",
                    coverImage : "images/page-img/profile-bg2.jpg",
                    Name : "Anna Sthesia",
                    Interests : "@designer",
                    About : "Lorem Ipsum is simply dummy text of the",
                },
                "4" : {
                    id: 4,
                    profileImg: "images/user/05.jpg",
                    coverImage : "images/page-img/profile-bg2.jpg",
                    Name : "Anna Sthesia",
                    Interests : "@designer",
                    About : "Lorem Ipsum is simply dummy text of the",
                },
            }
        }
    }
}
</script>