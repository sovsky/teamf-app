import {SiHelpscout} from "react-icons/si";

export default function PanelNavbar() {

    return (
        <nav className='sticky top-0 z-50 py-5 backdrop-blur-lg bg-violet-600 text-white'>
            <div className="container px-4 mx-auto relative text-sm">
                <div className="flex justify-between items-center">
                    <div className="flex items-center flex-shrink-0">
                        <SiHelpscout className='mr-1 w-6 h-6 text-white'/>
                        <span className='text-xl tracking-tight text-slate-200 font-semibold'>SąsiadWPotrzebie </span>
                    </div>
                </div>
            </div>
        </nav>
    )
}