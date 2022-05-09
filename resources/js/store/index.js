import Vuex from "vuex";
import auth from "./modules/auth";
import users from "./modules/users";
import articles from "./modules/articles";
import courses from "./modules/courses";
import lessons from "./modules/lessons";

export default new Vuex.Store({
    modules: {
        auth,
        users,
        articles,
        courses,
        lessons,
    },
});
