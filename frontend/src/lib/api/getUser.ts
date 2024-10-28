import API from "@/config/api.client.ts";

export default function getUser(token?: string) {
    return API.request({
        method: "GET",
        url: "/api/user",
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
}
