<template>
    <div class="iq-search-bar">
        <form action="#" class="searchbox">
            <input
                type="text"
                class="text search-input"
                placeholder="Type here to search..."
                v-model="value"
                @keyup="search"
                @keydown.space="space"
            />
            <!-- <a class="search-link" href="#"><i class="ri-search-line"></i></a> -->
            <div id="ser" v-if="results.length != 0" style="max-height: 400px;overflow: auto;">
                <!--  <p v-for="result in results" :key="result.id" class="ml-3">
                
            </p> -->
                <ul>
                    <li v-for="result in results" :key="result.id">
                        <router-link
                            :to="{
                                name: 'profile',
                                query: { user: result.id }
                            }"
                            v-on:click.native="vide()"
                            tag="a"
                            id="pp"
                            v-if="user.id != result.id"
                            >
                            <div class="">
                                <img
                                    class="avatar-40 rounded"
                                    :src="
                                        `images/user/${result.profileimg.name}`
                                    "
                                    alt="pp"
                                />
                            </div>
                            <span>{{ result.name }}</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        show: {
            type: Boolean,
            require: false
        }
    },
    data() {
        return {
            value: "",
            results: [],
            user: null,
            msg: "test"
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            //
            this.user = res.data;
        });
    },
    methods: {
        search() {
            if (this.value === "") {
                this.results = [];
            } else {
                axios
                    .post("/ProfileSearch", {
                        value: this.value
                    })
                    .then(response => {
                        this.results = response.data;
                    });
            }
        },
        space(e) {
            if (this.value === "") {
                e.preventDefault();
            }
        },
        vide() {
            this.value = "";
            this.results = [];
        }
    },
    watch: {
        show: function() {
            var search = document.getElementsByClassName("iq-search-bar");
            if (this.show) {
                search[0].style.display = "flex";
            } else {
                search[0].style.display = "none";
            }
        }
    }
};
</script>
