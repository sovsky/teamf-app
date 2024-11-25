import {createContext, Dispatch, ReactNode, SetStateAction, useEffect, useState} from "react";
import {useMutation} from "@tanstack/react-query";
import verifyToken from "@/lib/api/verifyToken.ts";

export interface IAuthData {
    email: string,
    name: string,
    role: string
}

interface ProviderProps {
    user: IAuthData,
    isLoading:boolean,
    setUser: Dispatch<SetStateAction<IAuthData>>
    logoutHandler: () => void
}

export const AuthContext = createContext<ProviderProps | null>(null)

export function AuthProvider({children}: { children: ReactNode }) {
    const [user, setUser] = useState<IAuthData>({
        email: "",
        name: "",
        role: ""
    })

    const {mutate,isPending} = useMutation({
        mutationKey: ["verifyToken"], 
        mutationFn: verifyToken, 
        onSuccess: (res) => {
            setUser({
                ...res.data.user
            })
        }
    })

    useEffect(() => {
        if (!user.email) {
            mutate()
        }
    }, []);

    const logoutHandler = () => {
        setUser({
            email: "",
            name: "",
            role: ""
        })
    }

    return (
        <AuthContext.Provider value={{user, isLoading:isPending, setUser, logoutHandler}}>
            {children}
        </AuthContext.Provider>
    )
}
