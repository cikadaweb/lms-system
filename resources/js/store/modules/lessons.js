import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    lessonsList: [],
    currentLesson: [],
    commentSuccess: false,
    errors: [],
};

const actions = {
    getLessons(ctx, course_id) {
        axios
            .get("/api/course-lessons/" + `?courseId=${course_id}`)
            .then((response) => {
                // отладка
                ctx.commit("setLessonsList", response.data.data);
                console.log("Получим наши уроки: ", response.data.data);
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },

    getLessonData(ctx, lesson_id) {
        axios
            .get("/api/course-lesson/" + `?lessonId=${lesson_id}`)
            .then((response) => {
                // отладка
                console.log(lesson_id);
                ctx.commit("setLessonData", response.data.data[0]);
                console.log("Получим данные урока: ", response.data.data[0]);
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },
};

const mutations = {
    setLessonsList(state, payload) {
        state.lessonsList = payload;
    },
    setLessonData(state, payload) {
        state.currentLesson = payload;
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
