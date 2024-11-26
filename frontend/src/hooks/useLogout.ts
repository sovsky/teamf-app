import {useMutation} from "@tanstack/react-query";

import useAuth from "@/hooks/useAuth.ts";
import { useNavigate } from "react-router-dom";
import { logout } from "@/lib/api/logout";


export default function useLogout() {
const navigate = useNavigate();
const {logoutHandler} = useAuth();
 
    const {mutate, status, error} = useMutation({
        mutationFn: ()=>logout(),
        onSuccess: () => {
            logoutHandler();
            navigate('/');
        }
    })

    return {handleLogout:mutate, status, error}
}
