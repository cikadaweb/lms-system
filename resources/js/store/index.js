import Vuex from "vuex";
import auth from "./modules/auth";
import users from "./modules/users";
import articles from "./modules/articles";

export default new Vuex.Store({
    modules: {
        auth,
        users,
        articles,
    },
});
