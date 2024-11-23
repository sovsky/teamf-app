import API from "@/config/api.client.ts";
import {LoginInputs} from "@/components/forms/login/loginForm.tsx";
import { IRegisterAdminData } from "@/hooks/useRegisterAdmin";

export default function registerAdmin(value: IRegisterAdminData) {
    console.log(value)
    return API.post("/admin/create",value)
  
}
