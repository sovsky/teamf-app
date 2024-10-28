import API from "@/config/api.client.ts";

export default function getCsrfCookie() {
    return API.request({
        method: "GET",
        url: "/api/csrf-cookie"
    })
}
