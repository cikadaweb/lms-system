import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    coursesList: [],
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
    getCourses(ctx) {
        axios
            .get("/api/courses")
            .then((response) => {
                // отладка
                ctx.commit("setCoursesList", response.data);
                console.log("Получим наши курсы: ", response.data);
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
    setCoursesList(state, payload) {
        state.coursesList = payload;
    },
};

const getters = {
    coursesList(state) {
        return state.coursesList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
