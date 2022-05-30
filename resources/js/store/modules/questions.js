import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {};

const actions = {
    addQuestion({}, data) {
        axios
            .post("/api/questions", {
                question: data.form.question,
                correct_answer: data.form.correct_answer,
                incorrect_answers: data.form.incorrect_answers,
                course_id: data.course_id,
            })
            .then((response) => {
                if (response.data) {
                    // отладка
                    console.log(response);
                    router.push(`/course-id${data.course_id}/lessons`);
                }
            })
            .catch((error) => {
                // отладка
                console.log(error.response);
            });
    },
};

const mutations = {};

const getters = {};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
