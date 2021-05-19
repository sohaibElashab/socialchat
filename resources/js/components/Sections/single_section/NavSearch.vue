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
            <div id="ser" v-if="results.length != 0">
                <!--  <p v-for="result in results" :key="result.id" class="ml-3">
                
            </p> -->
                <ul>
                    <li v-for="result in results" :key="result.id">
                        <router-link
                            :to="{
                                name: 'friendProfile',
                                params: { id: result.id },
                                query: { user: result.name }
                            }"
                            tag="a"
                            id="pp"
                            v-if="user.id != result.id"
                            ><!--  params matat khdemch fach ta tbdel luser fsearchbar ila 7iedt query -->
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
                        <router-link
                            :to="{
                                path: '/profile'
                            }"
                            tag="a"
                            id="pp"
                            v-if="user.id == result.id"
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
            //console.log(res.data);
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
                        console.log(response.data);
                        this.results = response.data;
                    });
            }
        },
        space(e) {
            if (this.value === "") {
                e.preventDefault();
            }
        }
    }
};
</script>

<style scoped>
#ser {
    position: absolute;
    width: 100%;
    background-color: #1e2745;
    color: #8c91b6;
}

#ser ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

#pp {
    display: flex;
    align-items: center;
    padding-left: 20px;
    width: 100%;
}
#pp:hover {
    background-color: #54649452;
}
#pp img {
    margin-right: 5px;
}

#pp span {
    color: #8c91b6;
}
</style>
