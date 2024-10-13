import {Routes, Route} from "react-router-dom";
import RootLayout from "./layouts/RootLayout";
import Home from "./pages/Home";
import Register from "@/pages/Register.tsx";


const App = () => {

    return (
        <Routes>
            <Route path="/" element={<RootLayout/>}>
                <Route index element={<Home/>}/>
            </Route>
            <Route path="/register" element={<Register/>}/>
        </Routes>
    )
}

export default App
