import {useMutation} from "@tanstack/react-query";
import login from "@/lib/api/login.ts";
import useAuth from "@/hooks/useAuth.ts";
import {useNavigate} from "react-router-dom";

export default function useLogin() {
    const navigate = useNavigate();
    const {setUser} = useAuth()

    const {mutate, status, error} = useMutation({
        mutationFn: login,
        onSuccess: (res) => {
            setUser({...res.data.user})
            navigate('/')
        }
    })

    return {mutate, status, error}
}
