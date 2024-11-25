import {useState} from "react";
import {useMutation} from "@tanstack/react-query";
import register from "@/lib/api/register.ts";
import useAuth from "@/hooks/useAuth.ts";

export type AccountType = "inNeed" | "volunteer";

export interface IRegisterData {
    role: AccountType;
    name: string;
    email: string;
    voivodeship: string;
    password: string;
    age: string;
    phone_number: string;
    city_id: number
}

export default function useRegister() {

    const {setUserWithStorage} = useAuth()
    const [formData, setFormData] = useState<IRegisterData>({
        role: "inNeed",
        name: "",
        email: "",
        password: "",
        voivodeship: "",
        age: "",
        phone_number: "",
        city_id: 0,
    })

    const {mutate, status, error} = useMutation({
        mutationFn: register,
        onSuccess: (data) => {
            setUserWithStorage(data.data.data)
        }
    })

    const submitHandler = (data: IRegisterData) => {
        mutate(data)
    }

    return {formData, setFormData, submitHandler, status, error}
}
