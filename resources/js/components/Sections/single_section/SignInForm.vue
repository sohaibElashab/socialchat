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
                    <a
                        class="float-right"
                        style="cursor:pointer"
                        @click="showForm"
                        >Forgot password?</a
                    >
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
                    <button class="btn btn-primary float-right" @click="login">
                        Sign in
                    </button>
                    <div id="reset" style="display:none">
                        <br /><br />
                        <hr />
                        <div class="form-group">
                            <label for="exampleInputPassword1"
                                >Enter email adress to recieve an email to reset
                                your password</label
                            >
                            <input
                                type="email"
                                class="form-control mb-0"
                                id="exampleInputPassword1"
                                placeholder="Email"
                                v-model="new_email"
                            />
                            <div class="form-text text-danger">
                                {{ new_email_err }}
                            </div>
                            <div class="form-text text-light">
                                {{ message }}
                            </div>
                        </div>
                        <button
                            class="btn btn-primary float-right"
                            @click="forgotPass"
                            id="send"
                        >
                            Send email
                        </button>
                    </div>
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
            password_err: "",
            new_email: "",
            new_email_err: "",
            message: ""
        };
    },
    mounted() {
        axios.post("/LogoutUser").then(res => {
            console.log(res);
        });
    },
    methods: {
        login(e) {
            e.preventDefault();
            axios
                .post("/login", {
                    email: this.email,
                    password: this.password
                })
                .then(res => {
                    sessionStorage.setItem("click_req", false);
                    sessionStorage.setItem("click_msg", false);
                    sessionStorage.setItem("click_not", false);
                    this.$router.push({ name: "home" });
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    this.email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                    this.password_err = error.errors.password
                        ? error.errors.password[0]
                        : "";
                });
        },
        showForm() {
            document.getElementById("reset").style.display = "initial";
        },
        forgotPass(e) {
            e.preventDefault();
            document.getElementById("send").disabled = true;
            axios
                .post("/ForgotPass", {
                    email: this.new_email
                })
                .then(res => {
                    if (res.data == "Invalid email") {
                        this.new_email_err = "Invalid email";
                    } else {
                        this.new_email_err = "";
                        this.message = res.data;
                    }
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    this.new_email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                });
        }
    }
};
</script>
