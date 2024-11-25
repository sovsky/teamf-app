import API from "@/config/api.client";

export const logout = async() =>{
return await API.post("/logout")
}