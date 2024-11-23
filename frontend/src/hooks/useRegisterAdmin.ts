import {useState} from "react";
import {useMutation} from "@tanstack/react-query";
import register from "@/lib/api/register.ts";
import useAuth from "@/hooks/useAuth.ts";
import registerAdmin from "@/lib/api/registerAdmin";
import usePopup from "./usePopup";
import { useToast } from "./use-toast";


export interface IRegisterAdminData {

    name: string;
    email: string;
    voivodeship:string;
    password: string;
    age: string;
    phone_number: string;
    city: string;
    helpTypes: string[];
}

export default function useRegisterAdmin() {
    const {popup,openPopup,closePopup} = usePopup()
    const { toast } = useToast()


    const {mutate, isPending, error} = useMutation({
        mutationFn: registerAdmin,
        onSuccess: (data) => {
            closePopup()
            toast({
                variant:"default",
                title:"Sukces",
                description:"Konto administratora zostało utworzone"
            })
        
    },
onError:(error)=>{
    toast({
        variant:"destructive",
        title:"Błąd",
        description:error?.response?.data?.message || error.message || "Wystąpił błąd"
    })
}
    }
)
    const errorMessage = error ? (error as any).response?.data?.message || error.message || "Wystąpił błąd" : null;

    const submitHandler = (data: IRegisterAdminData) => {
        mutate(data)
    }

    return { submitHandler, isPending, errorMessage}
}
