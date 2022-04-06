import axios from "axios";

const state = {
    errors: [],
    invalidCredentials: "",
};

const actions = {
    loginUser(ctx, user) {
        return new Promise((resolve) => {
            axios.get("/sanctum/csrf-cookie").then((response) => {
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
                            window.location.replace("/");
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
                            window.location.replace("/user/login");
                        }
                        if (
                            error.response.status === 422 ||
                            error.response.status === 500
                        ) {
                            ctx.commit(
                                "setInvalidCredentials",
                                error.response.data.message
                            );
                            ctx.commit("setErrors", error.response.data.errors);
                            console.log(error.response.data.errors);
                        }
                    });
            });
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
                            window.location.replace("/");
                        }
                    })
                    .catch((error) => {
                        if (
                            error.response.status === 422 ||
                            error.response.status === 500
                        ) {
                            ctx.commit(
                                "setInvalidCredentials",
                                error.response.data.message
                            );
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
            window.location.replace("user/login");
        });
    },
};

const mutations = {
    setErrors(state, errors) {
        state.errors = errors;
    },
    setInvalidCredentials(state, invalidCredentials) {
        state.invalidCredentials = invalidCredentials;
    },
};

const getters = {
    errors(state) {
        return state.errors;
    },
    invalidCredentials(state) {
        return state.invalidCredentials;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
