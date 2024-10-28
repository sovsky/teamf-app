import {Routes, Route, Navigate} from "react-router-dom";
import RootLayout from "./layouts/RootLayout";
import Home from "./pages/Home";
import Register from "@/pages/Register.tsx";
import Login from "@/pages/Login.tsx";
import FormsLayout from "@/layouts/FormsLayout.tsx";
import useAuth from "@/hooks/useAuth.ts";
import {useQuery} from "@tanstack/react-query";
import getCsrfCookie from "@/lib/api/getCsrfCookie.ts";


const App = () => {

    const {authData} = useAuth()
    useQuery({queryKey: ["csrfCookie"], queryFn: getCsrfCookie})

    return (
        <Routes>
            <Route path="/" element={<RootLayout/>}>
                <Route index element={<Home/>}/>
            </Route>
            <Route path="/" element={authData.token ? <Navigate to={"/"}/> : <FormsLayout/>}>
                <Route path="/register" element={<Register/>}/>
                <Route path="/login" element={<Login/>}/>
            </Route>
        </Routes>
    )
}

export default App
