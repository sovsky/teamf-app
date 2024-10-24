import {useMutation} from "@tanstack/react-query";
import login from "@/lib/api/login.ts";
import useAuth from "@/hooks/useAuth.ts";

export default function useLogin() {

    const {setAuthData} = useAuth()
    const {mutate, status, error} = useMutation({
        mutationFn: login,
        onSuccess: (data) => {
            setAuthData(data.data.data)
        }
    })

    return {mutate, status, error}
}
