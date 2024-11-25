import API from "@/config/api.client.ts";

export default function getUser(token?: string) {
    return API.request({
        method: "GET",
        url: "/user",
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
}
