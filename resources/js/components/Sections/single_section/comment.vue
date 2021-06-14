<template>
    <div>
        <ul class="post-comments p-0 m-0">
            <li class="mb-2" v-for="comment in comments" :key="comment.id">
                <div class="d-flex flex-wrap">
                    <div class="user-img">
                        <img
                            :src="comment.userImg"
                            alt="userimg"
                            class="avatar-35 rounded-circle img-fluid"
                        />
                    </div>
                    <div class="comment-data-block ml-3">
                        <h6>{{ comment.userName }}</h6>
                        <p class="mb-0">{{ comment.text }}</p>
                        <div
                            class="d-flex flex-wrap align-items-center comment-activity"
                        >
                            <a href="javascript:void();">like</a>
                            <a href="javascript:void();">reply</a>
                            <span> {{ comment.time }} </span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <form
            class="comment-text d-flex align-items-center mt-3"
            action="javascript:void(0);"
        >
            <input
                type="text"
                class="form-control rounded"
                placeholder="Write a comment…"
            />
            <div class="comment-attagement d-flex">
                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>
                <a href="javascript:void();"
                    ><i class="ri-user-smile-line mr-3"></i
                ></a>
                <a href="javascript:void();"
                    ><i class="ri-camera-line mr-3"></i
                ></a>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comments: {
                "1": {
                    id: 1,
                    userImg: "images/user/01.jpg",
                    userName: "Anna Sthesia",
                    text: "test g",
                    time: "Just Now"
                },
                "2": {
                    id: 2,
                    userImg: "images/user/03.jpg",
                    userName: "Barb Ackue",
                    statu: "ipsum dolor sit amet",
                    time: "1 hour ago"
                }
            },
        };
    },
    methods: {
    }
};
</script>
