import {Routes, Route, Navigate} from "react-router-dom";
import RootLayout from "./layouts/RootLayout";
import Home from "./pages/Home";
import Register from "@/pages/Register.tsx";
import Login from "@/pages/Login.tsx";
import FormsLayout from "@/layouts/FormsLayout.tsx";
import useAuth from "@/hooks/useAuth.ts";
import UserAuthLayout from "./layouts/UserAuthLayout";
import UserPanel from "./pages/AdminPanel";
import AdminLayout from "./layouts/AdminLayout";
import Volunteers from "./pages/Admin/Volunteers";
import PeopleInNeed from "./pages/Admin/PeopleInNeed";
import AdminPanel from "./pages/AdminPanel";
import MaterialHelp from "./pages/Admin/MaterialHelp";
import MedicalHelp from "./pages/Admin/MedicalHelp";
import PsychologicalHelp from "./pages/Admin/PsychologicalHelp";
import Comments from "./pages/Admin/Comments";
import Admins from "./pages/Admin/Admins";


const App = () => {

    const {user} = useAuth()

    return (
        <Routes>
            <Route path="/" element={<RootLayout/>}>
                <Route index element={<Home/>}/>
            </Route>
              <Route path="/" element={user.token ? <Navigate to={"/"}/> : <FormsLayout/>}>
                <Route path="/register" element={<Register/>}/>
                <Route path="/login" element={<Login/>}/>
            </Route>


            <Route path="/panel" element={<UserAuthLayout/>}>
                <Route index element={<UserPanel/>}/>
            </Route>

            <Route path="/admin" element={<AdminLayout/>}>
                <Route index element={<AdminPanel/>}/>
                <Route path="/admin/volunteers" element={<Volunteers/>}/>
                <Route path="/admin/peopleInNeed" element={<PeopleInNeed/>}/>
                <Route path="/admin/admins" element={<Admins/>}/>
                <Route path="/admin/material-help" element={<MaterialHelp/>}/>
                <Route path="/admin/medical-help" element={<MedicalHelp/>}/>
                <Route path="/admin/psychological-help" element={<PsychologicalHelp/>}/>
                <Route path="/admin/comments" element={<Comments/>}/>
          
            </Route>
        </Routes>
    )
}

export default App
