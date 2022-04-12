import Vuex from "vuex";
import auth from "./modules/auth";
import users from "./modules/users";
import news from "./modules/news";

export default new Vuex.Store({
    modules: {
        auth,
        users,
        news,
    },
});
