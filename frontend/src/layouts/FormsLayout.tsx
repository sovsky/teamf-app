import {Outlet} from "react-router-dom";

export default function FormsLayout() {

    return (
        <main className="h-screen flex justify-center items-center bg-violet-50 p-5">
                <Outlet/>
        </main>
    )
}
