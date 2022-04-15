import axios from "../../../axios/axios-instance";

const state = {
    articlesList: [],
    currentArticle: {},
};

const actions = {
    getArticles(ctx) {
        axios
            .get("/api/articles")
            .then((response) => {
                // пока смотрим что получим
                ctx.commit("setArticlesList", response.data.data);
                console.log("Получим наши статьи: ", response);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    getArticleData(ctx, id) {
        console.log("ID:", id);
        axios
            .get("/api/articles/" + id)
            .then((response) => {
                // пока смотрим что получим
                ctx.commit("setArticleData", response.data.data);
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    addArticle({}, article) {
        axios
            .post("/api/articles", {
                title: article.title,
                img: article.img,
                body: article.body,
            })
            .then((response) => {
                if (response.data) {
                    window.location.replace("/articles/dashboard");
                    console.log(response);
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
};

const mutations = {
    setArticlesList(state, payload) {
        state.articlesList = payload;
    },
    setArticleData(state, payload) {
        state.currentArticle = payload;
    },
};

const getters = {
    articlesList(state) {
        return state.articlesList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
