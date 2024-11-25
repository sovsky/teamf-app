import API from "@/config/api.client"
import {AxiosResponse} from "axios";
import {IVoivodeship} from "@/pages/Register.tsx";

export interface IVoivodeshipResponse {
    success: boolean,
    data: IVoivodeship[]
    message: string
}

export default function getVoivodeships(): Promise<AxiosResponse<IVoivodeshipResponse, string>> {
    return API.get("/voivodeships");
};