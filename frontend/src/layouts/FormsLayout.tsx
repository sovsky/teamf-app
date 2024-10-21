import {Outlet} from "react-router-dom";
import {motion} from "framer-motion";

export default function FormsLayout() {

    return (
        <motion.main initial={{opacity: 0}} animate={{opacity: 1}} className="h-screen flex justify-center items-center bg-violet-50 p-5">
                <Outlet/>
        </motion.main>
    )
}
