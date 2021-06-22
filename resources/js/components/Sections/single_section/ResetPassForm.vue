<template>
    <div class="col-md-6 bg-white pt-5">
        <div class="sign-in-from">
            <h1 class="mb-0">Reset password</h1>

            <form class="mt-4">
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
                    <label for="exampleInputPassword1">Confirm password</label>
                    <input
                        type="password"
                        class="form-control mb-0"
                        id="exampleInputPassword1"
                        placeholder="Password confirmation"
                        v-model="password_confirmation"
                    />
                </div>
                <div class="d-inline-block w-100">
                    <button class="btn btn-primary float-right" @click="reset">
                        Submit
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
            password: "",
            password_err: "",
            password_confirmation: ""
        };
    },
    mounted() {},
    methods: {
        reset() {
            axios
                .post("/ResetPassword", {
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then(res => {
                    this.$router.push({ name: "home" });
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    this.password_err = error.errors.password
                        ? error.errors.password[0]
                        : "";
                });
        }
    }
};
</script>
