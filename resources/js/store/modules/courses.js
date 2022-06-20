import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    currentCourse: {},
    coursesList: [],
    loading: false,
};

const actions = {
    getCourses(ctx) {
        ctx.commit("toggleLoading");
        axios
            .get("/api/courses")
            .then((response) => {
                ctx.commit("setCoursesList", response.data);
                console.log("Получим наши курсы: ", response.data);
                ctx.commit("toggleLoading");
            })
            .catch((error) => {
                console.log(error);
            });
    },
    getUserCourses(ctx, id) {
        console.log("ID юзера:", id);
        ctx.commit("toggleLoading");
        axios
            .get("/api/courses-user" + `?idUserCourses=${id}`)
            .then((response) => {
                ctx.commit("setCoursesList", response.data);
                console.log("Получим курсы пользователя: ", response.data);
                ctx.commit("toggleLoading");
            })
            .catch((error) => {
                console.log(error);
            });
    },
    getCourseData(ctx, id) {
        axios
            .get("/api/courses/" + id)
            .then((response) => {
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
                    console.log(response);
                    router.push("/courses/dashboard");
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
    changeCourse({}, course) {
        axios
            .put("/api/courses/" + course.id, {
                title: course.title,
                preview: course.preview,
                description: course.description,
                img: course.img,
            })
            .then((response) => {
                if (response.data) {
                    console.log(response);
                    router.push("/course-id" + course.id + "/lessons");
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
    changeStatusCourse({}, course_id) {
        console.log("Айди курса: ", course_id);
        axios
            .get("/api/course-change-status/" + `?courseId=${course_id}`)
            .then((response) => {
                if (response.data) {
                    console.log(response);
                    // router.push("/courses/dashboard");
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
    getCoursesBySearch(ctx, search_input) {
        axios
            .get("/api/courses-search/" + `?searchInput=${search_input}`)
            .then((response) => {
                console.log(response.data.data);
                ctx.commit("setCoursesList", response.data.data);
            })
            .catch((error) => {
                console.log(error);
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
    toggleLoading(state) {
        state.loading = !state.loading;
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
