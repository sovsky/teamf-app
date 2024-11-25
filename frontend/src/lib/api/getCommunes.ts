import API from "@/config/api.client.ts";
import {AxiosResponse} from "axios";
import {IVoivodeshipResponse} from "@/lib/api/getVoivodeships.ts";


export default function getCommunes(districtId = ""): Promise<AxiosResponse<IVoivodeshipResponse, string>> {
    const url = districtId ? `/districts/${districtId}/communes` : `/communes`
    return API.get(url);
}