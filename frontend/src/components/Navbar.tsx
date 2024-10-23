import React, {useEffect, useState} from 'react'
import {SiHelpscout} from "react-icons/si";
import {GiHamburgerMenu} from "react-icons/gi";
import {IoClose} from "react-icons/io5";

import {navItems} from '@/constants';
import {useWindowSize} from '@react-hook/window-size';
import {Link} from "react-router-dom";

const Navbar: React.FC = () => {

    const [mobileDrawerOpen, setMobileDrawerOpen] = useState<boolean>(false);
    const [windowWidth] = useWindowSize();

    useEffect(() => {
        if (windowWidth > 780) {
            setMobileDrawerOpen(false);
        }
    }, [windowWidth]);


    const toggleNavbar = (): void => {
        setMobileDrawerOpen((prevState) => !prevState);
    }

    return (
        <nav className='sticky top-0 z-50 py-5 backdrop-blur-lg bg-main'

        >
            <div className="container px-4 mx-auto relative text-sm">
                <div className="flex justify-between items-center">
                    <div className="flex items-center flex-shrink-0">

                        <SiHelpscout className='mr-1 w-6 h-6 text-button_primary'/>
                        <span className='text-xl tracking-tight text-slate-600 font-semibold'>SąsiadWPotrzebie </span>

                    </div>
                    <ul className='hidden lg:flex ml-14 space-x-12 font-semibold text-gray-700 text-lg'>
                        {navItems.map((item, index) => {
                            return (
                                <li key={index}>
                                    <a href={item.href}>{item.label}</a>
                                </li>
                            )
                        })}
                    </ul>
                    <div className="hidden lg:flex justify-center space-x-7 items-center ">
                        <Link to="/login" className='py-2 px-3 border rounded-md'>
                            Zaloguj
                        </Link>
                        <Link to="/register"
                              className='bg-button_primary text-neutral-50 border border-transparent font-semibold py-2 px-4 rounded-md'>
                            Dołącz
                        </Link>
                    </div>
                    <div className="lg:hidden md:flex flex-col justify-end">
                        <button onClick={toggleNavbar}>
                            {mobileDrawerOpen ? <IoClose/> : <GiHamburgerMenu/>}
                        </button>
                    </div>
                </div>
                {mobileDrawerOpen && (
                    <div
                        className='fixed right-0 z-20 bg-blue-50 w-full p-12 flex flex-col justify-center items-center lg:hidden'>
                        <ul>
                            {navItems.map((item, index) => {
                                return (
                                    <li key={index} className='py-4 font-semibold text-gray-700'>
                                        <Link to={item.href}>{item.label}</Link>
                                    </li>
                                )
                            })}
                        </ul>
                        <div className="flex space-x-6 ">
                            <Link to="/login" className='py-2 px-3 border rounded-md'>Zaloguj</Link>
                            <Link to="/register"
                                  className='bg-blue-500 py-2 px-3 rounded-md text-neutral-50 font-semibold'>
                                Dołącz
                            </Link>
                        </div>
                    </div>
                )}
            </div>
        </nav>
    )
}

export default Navbar
