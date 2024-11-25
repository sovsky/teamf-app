import API from "@/config/api.client.ts";
import {AxiosResponse} from "axios";
import {IAuthData} from "@/context/authContext.tsx";

interface IResponse {
    message: string,
    user: IAuthData
}

interface IError {
    message: string
}

export default function verifyToken(): Promise<AxiosResponse<IResponse, IError>> {
    return API.request({
        method: "GET",
        url: "/verifiedToken",
        withCredentials: true,
    })
}
