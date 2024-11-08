import axios from 'axios';

const opts = {
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
}

const API = axios.create(opts);

export default API;

