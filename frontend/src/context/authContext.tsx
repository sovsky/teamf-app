import {createContext, ReactNode,useState} from "react";

export interface IAuthData {
    email: string,
    token: string
}

interface ProviderProps {
    user: IAuthData,
    setUserWithStorage: (data: IAuthData) => void
    logoutHandler: () => void
}

export const AuthContext = createContext<ProviderProps | null>(null)

export function AuthProvider({children}: { children: ReactNode }) {
    const [user, setUser] = useState<IAuthData>({
        email: "",
        token: ""
    })

    // useEffect(() => {
    //     const auth = localStorage.getItem("auth")
    //     if (auth) {
    //         const data = JSON.parse(auth)

    //         if (typeof data.token === "string" && typeof data.email === "string") {
    //             setUser(data)
    //         }
    //     }
    // }, []);

    const setUserWithStorage = (data: IAuthData) => {
        setUser(data)
        // localStorage.setItem("auth", JSON.stringify(data))
    }

    const logoutHandler = () => {
        setUser({
            email: "",
            token: ""
        })
    }

    return (
        <AuthContext.Provider value={{user, setUserWithStorage, logoutHandler}}>
            {children}
        </AuthContext.Provider>
    )
}
