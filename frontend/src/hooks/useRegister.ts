import {useState} from "react";
import {useMutation} from "@tanstack/react-query";
import register from "@/lib/api/register.ts";
import useAuth from "@/hooks/useAuth.ts";
import {useNavigate} from "react-router-dom";

export type AccountType = "deprived person" | "volunteer";

export interface IRegisterData {
    role: AccountType;
    name: string;
    email: string;
    password: string;
    age: string;
    phone_number: string;
    city_id: number
}

export default function useRegister() {
    const navigate = useNavigate();
    const {setUser} = useAuth()
    const [formData, setFormData] = useState<IRegisterData>({
        role: "deprived person",
        name: "",
        email: "",
        password: "",
        age: "",
        phone_number: "",
        city_id: 0,
    })

    const {mutate, status, error} = useMutation({
        mutationFn: register,
        onSuccess: (_, variables) => {
            setUser({email: variables.email, name: variables.name, role: variables.role})
            navigate('/panel')
        }
    })

    const submitHandler = (data: IRegisterData) => {
        mutate(data)
    }

    return {formData, setFormData, submitHandler, status, error}
}
