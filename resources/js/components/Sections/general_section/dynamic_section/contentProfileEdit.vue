<template>
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="iq-edit-list">
                                <ul
                                    class="iq-edit-profile d-flex nav nav-pills"
                                >
                                    <li class="col-md-6 p-0">
                                        <a
                                            class="nav-link active"
                                            data-toggle="pill"
                                            href="#personal-information"
                                        >
                                            Personal Information
                                        </a>
                                    </li>
                                    <li class="col-md-6 p-0">
                                        <a
                                            class="nav-link"
                                            data-toggle="pill"
                                            href="#chang-pwd"
                                        >
                                            Change Password
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="iq-edit-list-data">
                        <div class="tab-content">
                            <div
                                class="tab-pane fade active show"
                                id="personal-information"
                                role="tabpanel"
                            >
                                <div class="iq-card">
                                    <div
                                        class="iq-card-header d-flex justify-content-between"
                                    >
                                        <div class="iq-header-title">
                                            <h4 class="card-title">
                                                Personal Information
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <form>
                                            <div
                                                class="form-group row align-items-center"
                                            >
                                                <div class="col-md-5">
                                                    <label for="fname"
                                                        >Profile image:</label
                                                    >
                                                    <div class="div-img-edit">
                                                        <div
                                                            class="profile-img-edit"
                                                        >
                                                            <img
                                                                class="profile-pic"
                                                                :src="profile"
                                                                alt="profile-pic"
                                                            />
                                                            <div
                                                                class="p-image"
                                                            >
                                                                <i
                                                                    class="ri-pencil-line upload-button"
                                                                    @click="
                                                                        prof
                                                                    "
                                                                ></i
                                                                ><!--  class="file-upload"-->
                                                                <input
                                                                    ref="prof"
                                                                    style="display:none;"
                                                                    type="file"
                                                                    accept="image/*"
                                                                    @change="
                                                                        onProfileChange
                                                                    "
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7">
                                                    <label for="fname"
                                                        >Cover image:</label
                                                    >
                                                    <div
                                                        class="profile-cover-img-edit"
                                                    >
                                                        <img
                                                            class="profile-cover-pic"
                                                            :src="cover"
                                                            alt="cover-pic"
                                                        />
                                                        <div
                                                            class="p-image Ip-image"
                                                        >
                                                            <i
                                                                class="ri-pencil-line upload-button"
                                                                @click="cov"
                                                            ></i
                                                            ><!--class="file-upload"  -->
                                                            <input
                                                                ref="cov"
                                                                style="display:none;"
                                                                type="file"
                                                                accept="image/*"
                                                                @change="
                                                                    onCoverChange
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class=" row align-items-center"
                                            >
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Full Name:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Full name"
                                                        v-model="name"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="name_err !== ''"
                                                    >
                                                        {{ name_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Email:</label
                                                    >
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="email@example.com"
                                                        v-model="email"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="email_err !== ''"
                                                    >
                                                        {{ email_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label class="d-block"
                                                        >Gender:</label
                                                    >
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
                                                        <label
                                                            class="custom-control-label"
                                                            for="customRadio6"
                                                        >
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
                                                        <label
                                                            class="custom-control-label"
                                                            for="customRadio7"
                                                        >
                                                            Female
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="gender_err !== ''"
                                                    >
                                                        {{ gender_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="dob"
                                                        >Date Of Birth:</label
                                                    >
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="dob"
                                                        v-model="birthdate"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            birthdate_err !== ''
                                                        "
                                                    >
                                                        {{ birthdate_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Phone number:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        v-model="mobile"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="mobile_err !== ''"
                                                    >
                                                        {{ mobile_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Languages:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="English,Spanish..."
                                                        v-model="language"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            language_err !== ''
                                                        "
                                                    >
                                                        {{ language_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-12"
                                                >
                                                    <label for="fname"
                                                        >Interests:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Designing,Gaming..."
                                                        v-model="interested"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            interested_err !==
                                                                ''
                                                        "
                                                    >
                                                        {{ interested_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-12"
                                                >
                                                    <label>Address:</label>
                                                    <textarea
                                                        class="form-control"
                                                        name="address"
                                                        rows="2"
                                                        placeholder="Current adress"
                                                        v-model="adress"
                                                    >
                                                    </textarea>
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="adress_err !== ''"
                                                    >
                                                        {{ adress_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-12"
                                                >
                                                    <label>About:</label>
                                                    <textarea
                                                        class="form-control"
                                                        name="address"
                                                        rows="2"
                                                        placeholder="About you"
                                                        v-model="about"
                                                    >
                                                    </textarea>
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="about_err !== ''"
                                                    >
                                                        {{ about_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-12"
                                                >
                                                    <label
                                                        >Favorite quote:</label
                                                    >
                                                    <textarea
                                                        class="form-control"
                                                        name="address"
                                                        rows="2"
                                                        placeholder="Favorite quote"
                                                        v-model="quote"
                                                    >
                                                    </textarea>
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="quote_err !== ''"
                                                    >
                                                        {{ quote_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Personal
                                                        website:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Personal website"
                                                        v-model="website"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            website_err !== ''
                                                        "
                                                    >
                                                        {{ website_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Facebook:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Facebook link"
                                                        v-model="facebook"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            facebook_err !== ''
                                                        "
                                                    >
                                                        {{ facebook_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Twitter:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Twitter link"
                                                        v-model="twitter"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            twitter_err !== ''
                                                        "
                                                    >
                                                        {{ twitter_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Instagram:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Instagram link"
                                                        v-model="instagram"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            instagram_err !== ''
                                                        "
                                                    >
                                                        {{ instagram_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Youtube:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Youtube link"
                                                        v-model="youtube"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            youtube_err !== ''
                                                        "
                                                    >
                                                        {{ youtube_err }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group col-sm-6"
                                                >
                                                    <label for="fname"
                                                        >Linkedin:</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="fname"
                                                        placeholder="Linkedin link"
                                                        v-model="linkedin"
                                                    />
                                                    <div
                                                        class="form-text text-danger"
                                                        v-if="
                                                            linkedin_err !== ''
                                                        "
                                                    >
                                                        {{ linkedin_err }}
                                                    </div>
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-primary mr-2"
                                                @click="send"
                                            >
                                                Submit
                                            </button>
                                            <button
                                                type="reset"
                                                class="btn iq-bg-danger"
                                            >
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="chang-pwd"
                                role="tabpanel"
                            >
                                <div class="iq-card">
                                    <div
                                        class="iq-card-header d-flex justify-content-between"
                                    >
                                        <div class="iq-header-title">
                                            <h4 class="card-title">
                                                Change Password
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="cpass"
                                                    >Current Password:</label
                                                >
                                                <a
                                                    href="javascripe:void();"
                                                    class="float-right"
                                                    >Forgot Password</a
                                                >
                                                <input
                                                    type="Password"
                                                    class="form-control"
                                                    id="cpass"
                                                    value=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="npass"
                                                    >New Password:</label
                                                >
                                                <input
                                                    type="Password"
                                                    class="form-control"
                                                    id="npass"
                                                    value=""
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="vpass"
                                                    >Verify Password:</label
                                                >
                                                <input
                                                    type="Password"
                                                    class="form-control"
                                                    id="vpass"
                                                    value=""
                                                />
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-primary mr-2"
                                            >
                                                Submit
                                            </button>
                                            <button
                                                type="reset"
                                                class="btn iq-bg-danger"
                                            >
                                                Cancle
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from "../../../../event-bus";
export default {
    data() {
        return {
            user: null,
            name: "",
            email: "",
            gender: "",
            birthdate: "",
            mobile: "",
            language: "",
            interested: "",
            adress: "",
            about: "",
            quote: "",
            website: "",
            facebook: "",
            twitter: "",
            instagram: "",
            youtube: "",
            linkedin: "",
            name_err: "",
            email_err: "",
            gender_err: "",
            birthdate_err: "",
            mobile_err: "",
            language_err: "",
            interested_err: "",
            adress_err: "",
            about_err: "",
            quote_err: "",
            website_err: "",
            facebook_err: "",
            twitter_err: "",
            instagram_err: "",
            youtube_err: "",
            linkedin_err: "",
            profile: "",
            cover: "",
            profile_img: null,
            cover_img: null
        };
    },
    mounted() {
        axios.get("/profile").then(res => {
            console.log(res.data);
            this.user = res.data;
            this.name = this.user.name;
            this.email = this.user.email;
            this.gender = this.user.gender;
            this.birthdate = this.user.birth_date;
            this.mobile = this.user.mobile;
            this.language = this.user.language;
            this.interested = this.user.interested;
            this.adress = this.user.adress;
            this.about = this.user.about;
            this.quote = this.user.quote;
            this.website = this.user.website;
            this.facebook = this.user.facebook;
            this.twitter = this.user.twitter;
            this.instagram = this.user.instagram;
            this.youtube = this.user.youtube;
            this.linkedin = this.user.linkedin;
            this.profile = `images/user/${this.user.profileimg.name}`;
            this.cover = `images/user/${this.user.coverimg.name}`;
        });
    },
    methods: {
        send() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            };
            let data = new FormData();
            data.append("cover", this.cover_img);
            data.append("profile", this.profile_img);
            data.append("name", this.name);
            data.append("email", this.email);
            data.append("gender", this.gender);
            data.append("about", this.about);
            data.append("birthdate", this.birthdate);
            data.append("mobile", this.mobile);
            data.append("language", this.language);
            data.append("interested", this.interested);
            data.append("adress", this.adress);
            data.append("quote", this.quote);
            data.append("website", this.website);
            data.append("facebook", this.facebook);
            data.append("twitter", this.twitter);
            data.append("instagram", this.instagram);
            data.append("youtube", this.youtube);
            data.append("linkedin", this.linkedin);

            //axios.post("/profile-update", data, config);
            axios
                .post("/profile-update", data, config)
                .then(res => {
                    console.log(res);
                    EventBus.$emit("user-update", res.data);
                })
                .catch(err => {
                    var error = JSON.parse(err.request.response);
                    this.name_err = error.errors.name
                        ? error.errors.name[0]
                        : "";
                    this.email_err = error.errors.email
                        ? error.errors.email[0]
                        : "";
                    this.gender_err = error.errors.gender
                        ? error.errors.gender[0]
                        : "";
                    this.birthdate_err = error.errors.birthdate
                        ? error.errors.birthdate[0]
                        : "";
                    this.mobile_err = error.errors.mobile
                        ? error.errors.mobile[0]
                        : "";
                    this.language_err = error.errors.language
                        ? error.errors.language[0]
                        : "";
                    this.interested_err = error.errors.interested
                        ? error.errors.interested[0]
                        : "";
                    this.adress_err = error.errors.adress
                        ? error.errors.adress[0]
                        : "";
                    this.about_err = error.errors.about
                        ? error.errors.about[0]
                        : "";
                    this.quote_err = error.errors.quote
                        ? error.errors.quote[0]
                        : "";
                    this.website_err = error.errors.website
                        ? error.errors.website[0]
                        : "";
                    this.facebook_err = error.errors.facebook
                        ? error.errors.facebook[0]
                        : "";
                    this.twitter_err = error.errors.twitter
                        ? error.errors.twitter[0]
                        : "";
                    this.instagram_err = error.errors.instagram
                        ? error.errors.instagram[0]
                        : "";
                    this.youtube_err = error.errors.youtube
                        ? error.errors.youtube[0]
                        : "";
                    this.linkedin_err = error.errors.linkedin
                        ? error.errors.linkedin[0]
                        : "";
                });
        },
        prof() {
            var p = this.$refs.prof;
            p.click();
        },
        cov() {
            var p = this.$refs.cov;
            p.click();
        },
        onProfileChange(e) {
            const file = e.target.files[0];
            this.profile = URL.createObjectURL(file);
            this.profile_img = file;
            console.log(this.profile_img);
        },
        onCoverChange(e) {
            const file = e.target.files[0];
            this.cover = URL.createObjectURL(file);

            this.cover_img = file;
            //console.log(this.cover_img);
        }
    }
};
</script>
