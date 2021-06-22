<template>
    <div class="col-md-6 bg-white pt-5">
        <div class="sign-in-from">
            <img src="images/login/mail.png" width="80" alt="" />
            <h1 class="mt-3 mb-0">Success !</h1>
            <p>
                Please check your emails and enter the code to verify your email
                adress.
            </p>
            <div class="form-group">
                <input
                    type="text"
                    class="form-control mb-0"
                    id="exampleInputPassword1"
                    placeholder="Code"
                    v-model="code"
                />
                <div class="form-text text-danger">
                    {{ code_err }}
                </div>
            </div>
            <div class="d-inline-block w-100">
                <button @click="check" class="btn btn-primary mt-3">
                    Submit
                </button>
                <button @click="resend" class="btn btn-primary mt-3">
                    Send code again
                </button>
                <br />
                <hr />
                <span class="dark-color d-inline-block line-height-2"
                    >Go back to
                    <router-link to="/signUp" tag="a"
                        >Sign up</router-link
                    ></span
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            code: "",
            code_err: "",
            org_code: "",
            user: null
        };
    },
    mounted() {
        axios.get("/verify").then(res => {
            this.org_code = res.data[0];
            this.user = res.data[1];
        });
    },
    methods: {
        resend() {
            this.code_err = "";
            axios.get("/verify").then(res => {
                this.org_code = res.data[0];
                this.user = res.data[1];
            });
        },
        check() {
            if (this.code == this.org_code) {
                axios
                    .post("/register", {
                        name: this.user.name,
                        email: this.user.email,
                        password: this.user.password,
                        password_confirmation: this.user.password,
                        mobile: this.user.mobile,
                        birthdate: this.user.birthdate,
                        gender: this.user.gender
                    })
                    .then(res => {
                        this.$router.push({ name: "home" });
                    });
            } else {
                this.code_err = "Invalid code";
            }
        }
    }
};
</script>
