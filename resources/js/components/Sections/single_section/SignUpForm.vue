<template>
    <div class="col-md-6 bg-white pt-5">
        <div class="sign-in-from">
            <h1 class="mb-0">Sign Up</h1>
            <!--  <p>Enter your email address and password to access admin panel.</p> -->
            <form class="mt-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Your Full Name</label>
                    <input
                        type="text"
                        class="form-control mb-0"
                        id="exampleInputEmail1"
                        placeholder="Your Full Name"
                        v-model="name"
                    />
                    <div class="form-text text-danger">
                        {{ name_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Email address</label>
                    <input
                        type="email"
                        class="form-control mb-0"
                        id="exampleInputEmail2"
                        placeholder="Enter email"
                        v-model="email"
                    />
                    <div class="form-text text-danger">
                        {{ email_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input
                        type="password"
                        class="form-control mb-0"
                        id="exampleInputPassword1"
                        placeholder="Password"
                        v-model="password"
                    />
                    <div class="form-text text-danger">
                        {{ password_err }}
                    </div>
                </div>
                <div class="d-inline-block w-100">
                    <!--  <div
                        class="custom-control custom-checkbox d-inline-block mt-2 pt-1"
                    >
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customCheck1"
                        />
                        <label class="custom-control-label" for="customCheck1"
                            >I accept
                            <a href="#">Terms and Conditions</a></label
                        >
                    </div> -->
                    <button
                        class="btn btn-primary float-right"
                        @click="register"
                    >
                        Sign Up
                    </button>
                    <button class="btn btn-primary float-right" @click="logout">
                        logout
                    </button>
                </div>
                <div class="sign-info">
                    <span class="dark-color d-inline-block line-height-2"
                        >Already Have Account ?
                        <router-link to="/signIn" tag="a">Log In</router-link>
                    </span>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            name_err: "",
            email_err: "",
            password_err: ""
        };
    },
    methods: {
        register() {
            console.log(this.name + "_" + this.email + "_" + this.password);
            axios
                .post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log(response.status + " " + response.statusText);
                    this.$router.push("profile");
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    this.name_err = error.errors.name
                        ? error.errors.name[0]
                        : "";
                    this.email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                    this.password_err = error.errors.password
                        ? error.errors.password[0]
                        : "";
                    //console.log(error.errors);
                });
        },
        logout() {
            axios.post("/logout").then(res => {
                console.log(res);
            });
        }
    }
};
</script>
