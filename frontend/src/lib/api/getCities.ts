import API from "@/config/api.client.ts";
import {AxiosResponse} from "axios";
import {IVoivodeshipResponse} from "@/lib/api/getVoivodeships.ts";

export default function getCities(communeId = ""): Promise<AxiosResponse<IVoivodeshipResponse, string>> {
    const url = communeId ? `/communes/${communeId}/cities` : `/cities`;
    return API.get(url);
}