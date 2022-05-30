import Vuex from "vuex";
import auth from "./modules/auth";
import users from "./modules/users";
import articles from "./modules/articles";
import courses from "./modules/courses";
import lessons from "./modules/lessons";
import tests from "./modules/tests";
import questions from "./modules/questions";

export default new Vuex.Store({
    modules: {
        auth,
        users,
        articles,
        courses,
        lessons,
        tests,
        questions,
    },
});
