import API from "@/config/api.client.ts";
import {LoginInputs} from "@/components/forms/login/loginForm.tsx";

export default function login(value: LoginInputs) {
    return API.request({
        url: "/api/login",
        method: "POST",
        data: value
    })
}
