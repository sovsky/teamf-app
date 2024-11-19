import axios from 'axios';
const BACKEND_URL = import.meta.env.VITE_BACKEND_BASE_URL
console.log(BACKEND_URL)
const opts = {

    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
baseURL:BACKEND_URL
}

const API = axios.create(opts);

export default API;

