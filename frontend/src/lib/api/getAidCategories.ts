import API from "@/config/api.client.ts";
import {AxiosResponse} from "axios";

export interface IAidCategory {
    id: number,
    name: string,
    aid_type: string
}

export interface IGetAidResponse {
    success: boolean,
    data: IAidCategory[]
}

export default function getAidCategories(): Promise<AxiosResponse<IGetAidResponse, string>> {
    return API.get('/aid-categories')
}