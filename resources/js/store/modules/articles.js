import axios from "../../../axios/axios-instance";

const state = {
    articlesList: [],
};

const actions = {
    getArticles(ctx) {
        axios
            .get("/api/articles")
            .then((response) => {
                // пока смотрим что получим
                ctx.commit("setArticlesList", response.data.data);
                console.log("Получим наши статьи: ");
                console.log(response);
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
