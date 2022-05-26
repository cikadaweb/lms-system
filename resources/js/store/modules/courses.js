import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    currentCourse: {},
    coursesList: [],
    // likeIt: false,
    // commentSuccess: false,
    // errors: [],
    // tagList: [],
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
    getCourseData(ctx, id) {
        axios
            .get("/api/courses/" + id)
            .then((response) => {
                // отладка
                ctx.commit("setCourseData", response.data.data);
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    addCourse({}, course) {
        axios
            .post("/api/courses", {
                title: course.title,
                img: course.img,
                preview: course.preview,
                description: course.description,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    console.log(response);
                    router.push("/courses/dashboard");
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
            });
    },
};

const mutations = {
    setCoursesList(state, payload) {
        state.coursesList = payload;
    },
    setCourseData(state, payload) {
        state.currentCourse = payload;
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
