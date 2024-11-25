import API from "@/config/api.client.ts";
import {IRegisterData} from "@/hooks/useRegister.ts";

export default function register(value: IRegisterData) {
    return API.request({
        method: "POST",
        url: "/register",
        data: value
    })
}
