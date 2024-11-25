import {useMutation} from "@tanstack/react-query";
import login from "@/lib/api/login.ts";
import useAuth from "@/hooks/useAuth.ts";
import {useNavigate} from "react-router-dom";

export default function useLogin() {
    const navigate = useNavigate();

    const {setUserWithStorage} = useAuth()
    const {mutate, status, error} = useMutation({
        mutationFn: login,
        onSuccess: () => {
            setUserWithStorage({email: "email@email.com", token: "12345"})
            navigate('/')
        }
    })

    return {mutate, status, error}
}
