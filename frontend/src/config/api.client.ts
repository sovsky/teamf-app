import axios from 'axios';

const opts = {
    baseURL:import.meta.env.VITE_BACKEND_BASE_URL,
    withCredentials:true,
}

const API = axios.create(opts);

export default API;

