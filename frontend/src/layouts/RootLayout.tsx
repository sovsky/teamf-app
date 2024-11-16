import React from 'react'
import {Outlet} from 'react-router-dom'
import Navbar from '../components/Navbar'
import {motion} from "framer-motion";

const RootLayout: React.FC = () => {
    return (
        <div className='flex flex-col'>
            <Navbar/>
            <motion.div initial={{opacity: 0}} animate={{opacity: 1, transition: {duration: 0.75}}}
                        className='bg-main '>
                <Outlet/>
            </motion.div>
        </div>
    )
}

export default RootLayout;
