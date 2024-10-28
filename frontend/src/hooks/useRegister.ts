import {useState} from "react";
import {useMutation} from "@tanstack/react-query";
import register from "@/lib/api/register.ts";
import useAuth from "@/hooks/useAuth.ts";

export type AccountType = "inNeed" | "volunteer";

export interface IRegisterData {
    accountType: AccountType;
    name: string;
    email: string;
    password: string;
    age: string;
    phone_number: string;
    city: string;
    helpTypes: string[];
}

export default function useRegister() {

    const {setUserWithStorage} = useAuth()
    const [formData, setFormData] = useState<IRegisterData>({
        accountType: "inNeed",
        name: "",
        email: "",
        password: "",
        age: "",
        phone_number: "",
        city: "",
        helpTypes: []
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
