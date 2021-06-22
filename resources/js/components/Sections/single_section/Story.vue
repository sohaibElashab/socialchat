<template>
    <div class="iq-card storiesSection">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Stories</h4>
            </div>
        </div>
        <div class="iq-card-body" style=" height: 400px; overflow: auto; ">
            <ul class="media-story m-0 p-0">
                <li class="d-flex flex-column">
                    <div class="d-flex mb-4 align-items-center" >
                        <i class=" imgStory ri-add-line font-size-18"></i>
                        <div class="stories-data ml-3">
                            <h5>Creat Your Story</h5>
                            <p class="mb-0">time to story</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4 align-items-center">
                        <i class=" imgStory ri-add-line font-size-18"></i>
                        <div class="stories-data ml-3">
                            <h5>Creat Your Story</h5>
                            <p class="mb-0">time to story</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4 align-items-center">
                        <i class=" imgStory ri-add-line font-size-18"></i>
                        <div class="stories-data ml-3">
                            <h5>Creat Your Story</h5>
                            <p class="mb-0">time to story</p>
                        </div>
                    </div>
                </li>
                <li
                    class="d-flex mb-4 align-items-center "
                    :class="{ active: story.isActive }"
                    v-for="story in storys"
                    :key="story.id"
                >
                    <img
                        :src="story.img"
                        alt="story-img"
                        class="rounded-circle img-fluid"
                    />
                    <div class="stories-data ml-3">
                        <h5>{{ story.h5 }}</h5>
                        <p class="mb-0">{{ story.p }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="showStories">
            <div class="stories"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            storys: {
                "1": {
                    id: 1,
                    isActive: true,
                    img: "images/page-img/s2.jpg",
                    h5: "Anna Mull",
                    p: "1 hour ago"
                },
                "2": {
                    id: 2,
                    isActive: false,
                    img: "images/page-img/s3.jpg",
                    h5: "Ira Membrit",
                    p: "4 hour ago"
                },
                "3": {
                    id: 3,
                    isActive: false,
                    img: "images/page-img/s1.jpg",
                    h5: "Bob Frapples",
                    p: "9 hour ago"
                }
            }
        };
    }
};
</script>

<style scoped>
.showStories {
    position: fixed;
    width: 100%;
    top: 0px;
    left: 0px;
    height: 100%;
    background: #00000078;
    display: none;
    justify-content: center;
}
.stories {
    position: absolute;
    height: 75vh;
    top: 15%;
    background: aliceblue;
    width: 25%;
}
.addstorie {
    position: relative;
    width: 100px;
    height: 10px;
    background: aliceblue;
}
</style>
