import axios from "axios";

const instance = axios.create({
    withCredentials: true,
    baseURL: process.env.VUE_APP_URL_API,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
    },
});

export default instance;
