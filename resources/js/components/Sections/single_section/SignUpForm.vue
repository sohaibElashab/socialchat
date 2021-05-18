<template>
    <div class="col-md-6 bg-white pt-5">
        <div class="sign-in-from">
            <h1 class="mb-0">Sign Up</h1>
            <!--  <p>Enter your email address and password to access admin panel.</p> -->
            <form class="mt-4 mb-4">
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
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirme Password</label>
                    <input
                        type="password"
                        class="form-control mb-0"
                        id="exampleInputPassword1"
                        placeholder="Confirme Password"
                        v-model="Cpassword"
                    />
                    <div class="form-text text-danger">
                        {{ password_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input
                        type="text"
                        class="form-control mb-0"
                        id="exampleInputPassword1"
                        placeholder="mobile"
                        v-model="mobile"
                    />
                    <div class="form-text text-danger">
                        {{ mobile_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Birth date</label>
                    <input
                        type="date"
                        class="form-control mb-0"
                        id="exampleInputPassword1"
                        placeholder="Password"
                        v-model="birthdate"
                    />
                    <div class="form-text text-danger">
                        {{ birthdate_err }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="d-block">Gender:</label>
                    <div
                        class="custom-control custom-radio custom-control-inline"
                    >
                        <input
                            type="radio"
                            id="customRadio6"
                            value="male"
                            class="custom-control-input"
                            v-model="gender"
                        />
                        <label class="custom-control-label" for="customRadio6">
                            Male
                        </label>
                    </div>
                    <div
                        class="custom-control custom-radio custom-control-inline"
                    >
                        <input
                            type="radio"
                            id="customRadio7"
                            value="female"
                            class="custom-control-input"
                            v-model="gender"
                        />
                        <label class="custom-control-label" for="customRadio7">
                            Female
                        </label>
                    </div>
                    <div class="form-text text-danger">
                        {{ gender_err }}
                    </div>
                </div>
                <div class="d-inline-block w-100">
                    <div class=" d-inline-block mt-2 pt-1">
                        <span class="dark-color d-inline-block line-height-2"
                            >Already Have Account ?
                            <router-link to="/signIn" tag="a"
                                >Log In</router-link
                            >
                        </span>
                    </div>
                    <button
                        class="btn btn-primary float-right"
                        @click="register"
                    >
                        Sign Up
                    </button>
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
            Cpassword: "",
            mobile: "",
            birthdate: "",
            gender: "",
            name_err: "",
            email_err: "",
            mobile_err: "",
            password_err: "",
            birthdate_err: "",
            gender_err: ""
        };
    },
    mounted() {
        axios.post("/logout").then(res => {
            console.log(res);
        });
    },
    methods: {
        register(e) {
            e.preventDefault();
            console.log(this.name + "_" + this.email + "_" + this.password);
            axios
                .post("/BeforeRegister", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.Cpassword,
                    mobile: this.mobile,
                    birthdate: this.birthdate,
                    gender: this.gender
                })
                .then(response => {
                    console.log(response.status + " " + response.statusText);
                    this.$router.push({ name: "verifyEmail" });
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    console.log(err);
                    this.name_err = error.errors.name
                        ? error.errors.name[0]
                        : "";
                    this.email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                    this.password_err = error.errors.password
                        ? error.errors.password[0]
                        : "";
                    this.mobile_err = error.errors.mobile
                        ? error.errors.mobile[0]
                        : "";
                    this.birthdate_err = error.errors.birthdate
                        ? error.errors.birthdate[0]
                        : "";
                    this.gender_err = error.errors.gender
                        ? error.errors.gender[0]
                        : "";
                    //console.log(error.errors);
                });
        }
    }
};
</script>
