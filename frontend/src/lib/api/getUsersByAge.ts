import API from "@/config/api.client"

export default function getUsersByAge() {
    return API.get("/users-by-age")
};