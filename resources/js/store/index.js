import Vuex from "vuex";
import auth from "./modules/auth";
import users from "./modules/users";

export default new Vuex.Store({
    modules: {
        auth,
        users,
    },
});
