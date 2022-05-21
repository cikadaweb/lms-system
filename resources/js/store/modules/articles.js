import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    articlesList: [],
    currentArticle: {
        comments: [],
        tags: [],
        statistic: {
            likes: 0,
            views: 0,
        },
    },
    likeIt: false,
    commentSuccess: false,
    errors: [],
    tagList: [],
};

const actions = {
    getArticles(ctx) {
        axios
            .get("/api/articles")
            .then((response) => {
                // отладка
                ctx.commit("setArticlesList", response.data.data);
                console.log("Статьи: ", response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },

    getArticleData(ctx, id) {
        axios
            .get("/api/articles/" + id)
            .then((response) => {
                // отладка
                ctx.commit("setArticleData", response.data.data);
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },

    deleteArticle({}, id) {
        axios.delete("/api/articles/" + id).catch((error) => {
            console.log(error.response);
        });
    },

    getArticlesBySearch(ctx, search_input) {
        axios
            .get("/api/articles-search/" + `?searchInput=${search_input}`)
            .then((response) => {
                console.log(response.data.data);
                ctx.commit("setArticlesList", response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },

    filterArticlesByStatus(ctx, filter_status) {
        axios
            .get("/api/articles-all/")
            .then((response) => {
                console.log(filter_status);
                if (filter_status != "1" && filter_status != "0") {
                    console.log("ada");
                    ctx.commit("setArticlesList", response.data.data);
                } else {
                    let filterData = response.data.data.filter((article) => {
                        return article.is_active == filter_status;
                    });
                    ctx.commit("setArticlesList", filterData);
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },

    // filterArticlesByTag(ctx, filter_role) {
    //     axios
    //         .get("/api/articles-all/")
    //         .then((response) => {
    //             if (
    //                 filter_role != "Admin" &&
    //                 filter_role != "Master" &&
    //                 filter_role != "User"
    //             ) {
    //                 ctx.commit("setUsersList", response.data.data);
    //             } else {
    //                 let filterData = response.data.data.filter((user) => {
    //                     return user.role.name === filter_role;
    //                 });
    //                 ctx.commit("setUsersList", filterData);
    //             }
    //         })
    //         .catch((error) => {
    //             console.log(error);
    //         });
    // },

    getTags(ctx) {
        axios
            .get("/api/article-tags")
            .then((response) => {
                // отладка
                ctx.commit("setTagList", response.data);
                console.log("Теги: ", response.data);
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
                preview: article.preview,
                body: article.body,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    console.log(response);
                    router.push("/articles/dashboard");
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
            });
    },

    changeArticle({}, article, id) {
        axios
            .put("/api/articles/" + article.id, {
                title: article.title,
                preview: article.preview,
                body: article.body,
                img: article.img,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    console.log(response);
                    router.push("/articles/" + article.id);
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
            });
    },

    viewsIncrement(ctx, payload) {
        setTimeout(() => {
            axios
                .put("/api/article-views-increment", { id: payload })
                .then((response) => {
                    ctx.commit("setArticleData", response.data.data);
                })
                .catch((error) => {
                    // отладка
                    console.log(error);
                });
        }, 5000);
    },

    addLike(ctx, payload) {
        axios
            .put("/api/article-likes-increment", {
                id: payload.id,
                increment: payload.increment,
            })
            .then((response) => {
                ctx.commit("setArticleData", response.data.data);
                ctx.commit("setLike", !state.likeIt);
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
        // отладка
        console.log("После клика по кнопке", state.likeIt);
    },

    addComment(ctx, payload) {
        axios
            .post("/api/article-add-comment", {
                body: payload.body,
                article_id: payload.article_id,
            })
            // ToDo работает неверно
            .then((response) => {
                // отладка
                console.log("Сюда не входим!");
                ctx.commit("setCommentSuccess", !state.commentSuccess);
                ctx.dispatch("getArticleData", payload.article_id);
            })
            .catch((error) => {
                if (error.response.status === 422) {
                    ctx.state.errors = error.response.data.errors;
                }
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
    setLike(state, payload) {
        state.likeIt = payload;
    },
    setCommentSuccess(state, payload) {
        state.commentSuccess = payload;
    },
    setTagList(state, payload) {
        state.tagList = payload;
    },
};

const getters = {
    articlesList(state) {
        return state.articlesList;
    },
    articleViews(state) {
        return state.currentArticle.statistic.views;
    },
    articleLikes(state) {
        return state.currentArticle.statistic.likes;
    },
    tagList(state) {
        return state.tagList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
