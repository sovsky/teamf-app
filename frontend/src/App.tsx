import {Routes, Route} from "react-router-dom";
import RootLayout from "./layouts/RootLayout";
import Home from "./pages/Home";
import Register from "@/pages/Register.tsx";
import Login from "@/pages/Login.tsx";
import UserAuthLayout from "./layouts/UserAuthLayout";
import UserPanel from "./pages/UserPanel";
import AdminLayout from "./layouts/AdminLayout";
import Volunteers from "./pages/Admin/Volunteers";
import PeopleInNeed from "./pages/Admin/PeopleInNeed";
import AdminPanel from "./pages/UserPanel";
import MaterialHelp from "./pages/Admin/MaterialHelp";
import MedicalHelp from "./pages/Admin/MedicalHelp";
import PsychologicalHelp from "./pages/Admin/PsychologicalHelp";


const App = () => {

    return (
        <Routes>
            <Route path="/" element={<RootLayout/>}>
                <Route index element={<Home/>}/>
            </Route>
            <Route path="/register" element={<Register/>}/>
            <Route path="/login" element={<Login/>}/>


            <Route path="/panel" element={<UserAuthLayout/>}>
                <Route index element={<UserPanel/>}/>
            </Route>

            <Route path="/admin" element={<AdminLayout/>}>
                <Route index element={<AdminPanel/>}/>
                <Route path="/admin/volunteers" element={<Volunteers/>}/>
                <Route path="/admin/peopleInNeed" element={<PeopleInNeed/>}/>
                <Route path="/admin/meterial-help" element={<MaterialHelp/>}/>
                <Route path="/admin/medical-help" element={<MedicalHelp/>}/>
                <Route path="/admin/psychological-help" element={<PsychologicalHelp/>}/>
            </Route>

        </Routes>
    )
}

export default App
