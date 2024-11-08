import {AuthContext} from "@/context/authContext.tsx";
import {useContext} from "react";

export default function useAuth() {
    const ctx = useContext(AuthContext)

    if (!ctx) {
        throw new Error("useAuth must be used within an AuthProvider")
    }

    return ctx
}
