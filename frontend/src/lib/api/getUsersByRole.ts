import API from "@/config/api.client"

export const getUsersByRole= async({role}:{role:string})=> {
    const {data} = await API.get(`/admin/role/${role}`);
    return data;
};