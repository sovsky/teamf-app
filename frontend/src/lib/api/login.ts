import API from "@/config/api.client.ts";
import {LoginInputs} from "@/components/forms/login/loginForm.tsx";
import {AxiosResponse} from "axios";
import {IAuthData} from "@/context/authContext.tsx";

interface IResponse {
    message: string,
    user: IAuthData
}

export default function login(value: LoginInputs): Promise<AxiosResponse<IResponse, string>> {
    return API.post("/login", value)
}
