import axios_default from "axios";
import axios from "../../../axios/axios-instance";
import router from "../../router/router";

const state = {
    currentUser: {},
    userList: [],
    roleList: [],
    permissionsList: [],
    errors: [],
    loading: false,
};

const actions = {
    getUsers(ctx) {
        ctx.commit("toggleLoading");
        axios
            .get("/api/users")
            .then((response) => {
                ctx.commit("setUsersList", response.data.data);
                ctx.commit("toggleLoading");
            })
            .catch((error) => {
                console.log(error);
            });
    },

    addUser(ctx, user) {
        ctx.commit("clearErrors");
        axios_default
            .post("/api/users", {
                name: user.name,
                email: user.email,
                role: user.role.name,
                password: user.password,
                password_confirmation: user.password_confirmation,
            })
            .then((response) => {
                if (response.data) {
                    console.log(response);
                }
            })
            .catch((error) => {
                if (
                    error.response.status === 422 ||
                    error.response.status === 500
                ) {
                    ctx.commit("setErrors", error.response.data.errors);
                    console.log(error.response.data.errors);
                }
            });
    },

    getUserData(ctx, id) {
        axios
            .get("/api/users/" + id)
            .then((response) => {
                ctx.commit("setUserData", response.data.data);
                console.log(response.data.data);
            })
            .catch((error) => {
                // отладка
                console.log(error);
            });
    },

    updateUserData(ctx, userData) {
        axios
            .put("/api/users/" + userData.id, {
                id: userData.id,
                name: userData.name,
                email: userData.email,
                role: userData.role,
            })
            .then((response) => {
                router.push("/users/dashboard");
            });
    },

    deleteUser({}, id) {
        axios.delete("/api/users/" + id).catch((error) => {
            console.log(error.response);
        });
    },

    getUsersBySearch(ctx, search_input) {
        axios
            .get("/api/users-search/" + `?searchInput=${search_input}`)
            .then((response) => {
                console.log(response.data.data);
                ctx.commit("setUsersList", response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },

    filterUsersByStatus(ctx, filter_role) {
        axios
            .get("/api/users-all/")
            .then((response) => {
                if (
                    filter_role != "Admin" &&
                    filter_role != "Master" &&
                    filter_role != "User"
                ) {
                    ctx.commit("setUsersList", response.data.data);
                } else {
                    let filterData = response.data.data.filter((user) => {
                        return user.role.name === filter_role;
                    });
                    ctx.commit("setUsersList", filterData);
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
    exportAllUsers() {
        axios
            .get("/api/users-export", {
                responseType: "arraybuffer",
            })
            .then((response) => {
                let fileURL = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                let fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", "users.xlsx");
                document.body.appendChild(fileLink);
                fileLink.click();
            })
            .catch((error) => {
                console.log(error);
            });
    },

    getRoles(ctx) {
        axios
            .get("/api/roles")
            .then((response) => {
                ctx.commit("setRoleList", response.data.data);
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    addRole({}, role) {
        axios
            .post("/api/roles", {
                name: role.name,
            })
            .then((response) => {
                if (response.data) {
                    router.push("/user/management");
                    console.log(response);
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
    getPermissions(ctx) {
        axios
            .get("/api/permissions")
            .then((response) => {
                ctx.commit("setPermissionsList", response.data.data);
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    addPermission({}, permission) {
        axios
            .post("/api/permissions", {
                name: permission.name,
            })
            .then((response) => {
                if (response.data) {
                    router.push("/user/permissions");
                    console.log(response);
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
    },
};

const mutations = {
    setUsersList(state, payload) {
        state.userList = payload;
    },
    setUserData(state, payload) {
        state.currentUser = payload;
    },
    setRoleList(state, payload) {
        state.roleList = payload;
    },
    setPermissionsList(state, payload) {
        state.permissionsList = payload;
    },
    setErrors(state, errors) {
        state.errors = errors;
    },
    clearErrors(state) {
        state.errors = [];
    },
    toggleLoading(state) {
        state.loading = !state.loading;
    },
};

const getters = {
    userList(state) {
        return state.userList;
    },
    currentUser(state) {
        return state.currentUser;
    },
    roleList(state) {
        return state.userList;
    },
    permissionsList(state) {
        return state.permissionsList;
    },
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};
