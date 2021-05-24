<template>
    <div class="tab-pane fade" id="about" role="tabpanel">
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="row">
                    <div class="col-md-3">
                        <ul
                            class="nav nav-pills basic-info-items list-inline d-block p-0 m-0"
                        >
                            <li>
                                <a
                                    class="nav-link active"
                                    data-toggle="pill"
                                    href="#basicinfo"
                                    >Contact Information</a
                                >
                            </li>
                            <li>
                                <a
                                    class="nav-link"
                                    data-toggle="pill"
                                    href="#family"
                                    >Websites and Social
                                    Links</a
                                >
                            </li>
                            <li>
                                <a
                                    class="nav-link"
                                    data-toggle="pill"
                                    href="#work"
                                    >Basic Information</a
                                >
                            </li>
                            <li>
                                <a
                                    class="nav-link"
                                    data-toggle="pill"
                                    href="#lived"
                                >
                                    About You</a
                                >
                            </li>
                            <li>
                                <a
                                    class="nav-link"
                                    data-toggle="pill"
                                    href="#details"
                                    >Favorite Quotes</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 pl-4">
                        <div class="tab-content">
                            <div
                                class="tab-pane fade active show"
                                id="basicinfo"
                                role="tabpanel"
                            >
                                <h4>Contact Information</h4>
                                <hr />
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Email</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{ user.email }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Mobile</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.mobile
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Address</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.adress
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="family"
                                role="tabpanel"
                            >
                                <h4 class="mt-3">
                                    Websites and Social
                                    Links
                                </h4>
                                <hr />
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Website</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.website
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Social Link</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.facebook
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="work"
                                role="tabpanel"
                            >
                                <h4 class="mt-3">
                                    Basic Information
                                </h4>
                                <hr />
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Birth Date</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                new Date(
                                                    user.birth_date
                                                ).getDate()
                                            }}
                                            {{
                                                new Date(
                                                    user.birth_date
                                                ).toLocaleString(
                                                    "default",
                                                    {
                                                        month:
                                                            "long"
                                                    }
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Birth Year</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                new Date(
                                                    user.birth_date
                                                ).getFullYear()
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Gender</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.gender
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>
                                            interested in
                                        </h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.interested
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h6>language</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0">
                                            {{
                                                user.language
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="lived"
                                role="tabpanel"
                            >
                                <h4 class="mb-3">
                                    About You
                                </h4>
                                <p>
                                    {{ user.about }}
                                </p>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="details"
                                role="tabpanel"
                            >
                                <h4 class="mt-3 mb-3">
                                    Favorite Quotes
                                </h4>
                                <p>
                                    {{ user.quote }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            require: true
        },
    }
}
</script>