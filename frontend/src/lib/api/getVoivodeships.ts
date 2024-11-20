import API from "@/config/api.client"

export default function getVoivodeships() {
    const response =  API.get("/voivodeships");
    return response.data
};