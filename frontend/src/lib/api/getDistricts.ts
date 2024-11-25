import API from "@/config/api.client.ts";
import {IVoivodeship} from "@/pages/Register.tsx";
import {AxiosResponse} from "axios";

interface IResponse {
    success: boolean,
    data: IVoivodeship[]
    message: string
}

export default function getDistricts(voivodeshipId = ""): Promise<AxiosResponse<IResponse, string>> {
    const url = voivodeshipId ? `/voivodeships/${voivodeshipId}/districts` : `/districts`
    return API.get(url);
}