import API from "@/config/api.client.ts";
import {LoginInputs} from "@/components/forms/login/loginForm.tsx";

export default function login(value: LoginInputs) {
    console.log(value)
    return API.post("/login",value)
  
}
