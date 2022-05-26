import axios from "axios";
import router from "../../router/router";

const state = {
    authUser: {},
    errors: [],
    // invalidCredentials: "",
};

const actions = {
    loginUser(ctx, user) {
        return new Promise((resolve) => {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                ctx.commit("clearErrors");
                axios
                    .post("/login", {
                        email: user.email,
                        password: user.password,
                    })
                    .then((response) => {
                        if (response.data) {
                            localStorage.setItem(
                                "x-token",
                                response.config.headers["X-XSRF-TOKEN"]
                            );
                            this.dispatch("auth/getLoginUserData");
                            router.push("/");
                        }
                    })
                    .catch((error) => {
                        if (
                            error.response.status === 401 ||
                            error.response.status === 419
                        ) {
                            const token = localStorage.getItem("x-token");
                            if (token) {
                                localStorage.removeItem("x-token");
                            }
                            router.push("/user/login");
                        }
                        if (
                            error.response.status === 422 ||
                            error.response.status === 500
                        ) {
                            // ctx.commit(
                            //     "setInvalidCredentials",
                            //     error.response.data.message
                            // );
                            ctx.commit("setErrors", error.response.data.errors);
                            console.log(error.response.data.errors);
                        }
                    });
            });
        });
    },

    getLoginUserData(ctx) {
        axios.get("/api/getRole").then((response) => {
            let user = {};
            user.id = response.data.userId;
            user.name = response.data.userName[0].name;
            user.role = response.data.userRole;
            ctx.commit("setAuthUser", user);
        });
    },

    registerUser(ctx, user) {
        return new Promise((resolve) => {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/register", {
                        name: user.name,
                        email: user.email,
                        password: user.password,
                        password_confirmation: user.password_confirmation,
                    })
                    .then((response) => {
                        if (response.data) {
                            localStorage.setItem(
                                "x-token",
                                response.config.headers["X-XSRF-TOKEN"]
                            );
                            router.push("/");
                        }
                    })
                    .catch((error) => {
                        if (
                            error.response.status === 422 ||
                            error.response.status === 500
                        ) {
                            // ctx.commit(
                            //     "setInvalidCredentials",
                            //     error.response.data.message
                            // );
                            ctx.commit("setErrors", error.response.data.errors);
                            console.log(error.response.data.errors);
                        }
                    });
            });
        });
    },
    logout() {
        axios.post("/logout").then((response) => {
            localStorage.removeItem("x-token");
            router.push("/user/login");
        });
    },
};

const mutations = {
    setErrors(state, errors) {
        state.errors = errors;
    },
    clearErrors(state) {
        state.errors = [];
    },

    setAuthUser(state, user) {
        state.authUser = user;
    },

    // setInvalidCredentials(state, invalidCredentials) {
    //     state.invalidCredentials = invalidCredentials;
    // },
};

const getters = {
    errors(state) {
        return state.errors;
    },
    authUser(state) {
        return state.authUser;
    },
    // invalidCredentials(state) {
    //     return state.invalidCredentials;
    // },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
