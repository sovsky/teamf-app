import API from "@/config/api.client.ts";

interface IAidData {
    aid_type_id: number,
    aid_category_id: number,
}

export default function saveUserAid(data: IAidData) {
    return API.post("/aid", data)
}