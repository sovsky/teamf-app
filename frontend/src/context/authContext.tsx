import {createContext, Dispatch, ReactNode, SetStateAction, useState} from "react";

interface IAuthData {
    email: string,
    token: string
}

interface ProviderProps {
    authData: IAuthData,
    setAuthData: Dispatch<SetStateAction<IAuthData>>,
    logoutHandler: () => void
}

export const AuthContext = createContext<ProviderProps | null>(null)

export function AuthProvider({children}: { children: ReactNode }) {
    const [authData, setAuthData] = useState<IAuthData>({
        email: "",
        token: ""
    })

    const logoutHandler = () => {
        setAuthData({
            email: "",
            token: ""
        })
    }

    return (
        <AuthContext.Provider value={{authData, setAuthData, logoutHandler}}>
            {children}
        </AuthContext.Provider>
    )
}
