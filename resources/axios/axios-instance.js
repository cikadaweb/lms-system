import axios from "axios";

const instance = axios.create({
    withCredentials: true,
    baseURL: process.env.VUE_APP_URL_API,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
    },
});

instance.interceptors.response.use({}, (error) => {
    if (error.response.status === 401 || error.response.status === 419) {
        const token = localStorage.getItem("x-token");
        if (token) {
            localStorage.removeItem("x-token");
        }
        window.location.replace("/user/login");
    }
});

// axios.interceptors.response.use(
//     (response) => {},
//     (error) => {
//         if (error.response.status === 401 || error.response.status === 419) {
//             const token = localStorage.getItem("x-token");
//             if (token) {
//                 localStorage.removeItem("x-token");
//             }
//             window.location.replace("/user/login");
//         }
//         return Promise.reject(error.response.data);
//     }
// );

export default instance;
