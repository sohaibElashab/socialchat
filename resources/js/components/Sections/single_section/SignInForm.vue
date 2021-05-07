<template>
    <div class="col-md-6 bg-white pt-5">
        <div class="sign-in-from">
            <h1 class="mb-0">Sign in</h1>
            <!--    <p>
                Enter your email address and password to access
                admin panel.
            </p> -->
            <form class="mt-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input
                        type="email"
                        class="form-control mb-0"
                        id="exampleInputEmail1"
                        placeholder="Enter email"
                        v-model="email"
                    />
                    <div class="form-text text-danger">
                        {{ email_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <a href="#" class="float-right">Forgot password?</a>
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
                    <!--   <div
                        class="custom-control custom-checkbox d-inline-block mt-2 pt-1"
                    >
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customCheck1"
                        />
                        <label class="custom-control-label" for="customCheck1"
                            >Remember Me</label
                        >
                    </div> -->
                    <button class="btn btn-primary float-right" @click="login">
                        Sign in
                    </button>
                    <button class="btn btn-primary float-right" @click="logout">
                        logout
                    </button>
                </div>
                <div class="sign-info">
                    <span class="dark-color d-inline-block line-height-2"
                        >Don't have an account?
                        <router-link to="/signUp" tag="a"
                            >Sign up</router-link
                        ></span
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            email_err: "",
            password_err: ""
        };
    },
    methods: {
        login() {
            axios
                .post("/login", {
                    email: this.email,
                    password: this.password
                })
                .then(res => {
                    console.log(res);
                    this.$router.push("profile");
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    console.log(error.errors);
                    this.email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                    this.password_err = error.errors.password
                        ? error.errors.password[0]
                        : "";
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
