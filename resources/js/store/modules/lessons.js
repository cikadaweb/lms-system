import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    lessonsList: [],
    currentLesson: [],
    loading: false,
};

const actions = {
    getLessons(ctx, course_id) {
        ctx.commit("toggleLoading");
        axios
            .get("/api/course-lessons/" + `?courseId=${course_id}`)
            .then((response) => {
                // отладка
                ctx.commit("setLessonsList", response.data.data);
                console.log("Получим наши уроки: ", response.data.data);
                ctx.commit("toggleLoading");
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },

    getLessonData(ctx, lesson_id) {
        ctx.commit("toggleLoading");
        axios
            .get("/api/course-lesson/" + `?lessonId=${lesson_id}`)
            .then((response) => {
                // отладка
                // console.log(lesson_id);
                ctx.commit("setLessonData", response.data.data[0]);
                console.log("Получим данные урока: ", response.data.data[0]);
                ctx.commit("toggleLoading");
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },
    addLesson({}, data) {
        axios
            .post("/api/lessons", {
                title: data.form.title,
                body: data.form.body,
                course_id: data.course_id,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    router.push(`/course-id${data.course_id}/lessons`);
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
            });
    },
    changeLesson({}, data) {
        console.log(data.course_id);
        axios
            .put("/api/lessons/" + data.lesson.id, {
                title: data.lesson.title,
                lesson_file: data.lesson.lesson_file,
                body: data.lesson.body,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    console.log(response);
                    router.push(
                        `/course-id${data.course_id}/lesson-id${data.lesson.id}`
                    );
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
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
    toggleLoading(state) {
        state.loading = !state.loading;
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
