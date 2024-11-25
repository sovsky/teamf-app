import API from "@/config/api.client.ts";
import {AxiosResponse} from "axios";

export interface IMatchingUser {
    id: number,
    name: string,
    city: string,
    latest_selection: {
        aid_type: string,
        aid_category: string,
        product_category: string,
        products: string,
    }
}

export interface IMatchingResponse {
    data: IMatchingUser[]
}

export default function getMatchingUsers(): Promise<AxiosResponse<IMatchingResponse, string>> {
    return API.request({
        method: "GET",
        url: "/matching-users",
        withCredentials: true
    })
}