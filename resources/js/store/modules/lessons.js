import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    lessonsList: [],
    // currentArticle: {
    //     comments: [],
    //     tags: [],
    //     statistic: {
    //         likes: 0,
    //         views: 0,
    //     },
    // },
    likeIt: false,
    commentSuccess: false,
    errors: [],
    tagList: [],
};

const actions = {
    getLessons(ctx) {
        axios
            .get("/api/course-lessons")
            .then((response) => {
                // отладка
                ctx.commit("setLessonsList", response.data);
                console.log("Получим наши уроки: ", response.data);
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },

    // getArticleData(ctx, id) {
    //     axios
    //         .get("/api/articles/" + id)
    //         .then((response) => {
    //             // отладка
    //             ctx.commit("setArticleData", response.data.data);
    //             console.log(response.data.data);
    //         })
    //         .catch((error) => {
    //             // отладка
    //             console.log(error);
    //         });
    // },
};

const mutations = {
    setLessonsList(state, payload) {
        state.lessonsList = payload;
    },
};

const getters = {
    lessonsList(state) {
        return state.lessonsList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
