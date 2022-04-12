import axios from "../../../axios/axios-instance";

const state = {
    newsList: [],
};

const actions = {
    getNews(ctx) {
        axios
            .get("/api/articles")
            .then((response) => {
                ctx.commit("setNewsList", response.data);
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    addUser({}, user) {
        axios
            .post("/api/users", {
                name: user.name,
                email: user.email,
                role: user.role.name,
                password: user.password,
                password_confirmation: user.password_confirmation,
            })
            .then((response) => {
                if (response.data) {
                    window.location.replace("/user/dashboard");
                    console.log(response);
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
};

const mutations = {
    setNewsList(state, payload) {
        state.newsList = payload;
    },
};

const getters = {
    newsList(state) {
        return state.newsList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
